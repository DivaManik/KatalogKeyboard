<?php

namespace App\Http\Controllers;

use App\Keyboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KeyboardController extends Controller
{
    /**
     * Available options for dropdown fields.
     *
     * @var array<string, array<int, string>>
     */
    private $options = [
        'connection' => ['wired', 'wireless', 'hybrid'],
        'layout'     => ['60%', '65%', '75%', 'TKL', 'Fullsize'],
    ];

    /**
     * Display home page with statistics.
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        $keyboards = Keyboard::all();
        $totalKeyboards = $keyboards->count();
        $brandCount = $keyboards->pluck('brand')->unique()->count();
        $hotSwapCount = $keyboards->where('hot_swappable', true)->count();
        $hotSwapPercentage = $totalKeyboards > 0 ? round(($hotSwapCount / $totalKeyboards) * 100) : 0;
        $latestKeyboards = Keyboard::whereNotNull('release_date')
            ->orderBy('release_date', 'desc')
            ->take(3)
            ->get();

        $connectionBreakdown = [
            'wired' => $keyboards->where('connection', 'wired')->count(),
            'wireless' => $keyboards->where('connection', 'wireless')->count(),
            'hybrid' => $keyboards->where('connection', 'hybrid')->count(),
        ];

        return view('home', compact(
            'totalKeyboards',
            'brandCount',
            'hotSwapCount',
            'hotSwapPercentage',
            'latestKeyboards',
            'connectionBreakdown'
        ));
    }

    /**
     * Display a listing of the keyboards.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Keyboard::query();

        // Filter by search keyword
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('brand', 'LIKE', "%{$search}%")
                  ->orWhere('switch_type', 'LIKE', "%{$search}%");
            });
        }

        // Filter by brand
        if ($request->filled('brand')) {
            $query->whereIn('brand', $request->brand);
        }

        // Filter by connection
        if ($request->filled('connection')) {
            $query->whereIn('connection', $request->connection);
        }

        // Filter by layout/size
        if ($request->filled('layout')) {
            $query->whereIn('layout', $request->layout);
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sort by price
        if ($request->filled('sort')) {
            if ($request->sort === 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === 'price_desc') {
                $query->orderBy('price', 'desc');
            }
        } else {
            $query->latest();
        }

        $keyboards = $query->get();

        // Get unique brands for filter
        $brands = Keyboard::select('brand')->distinct()->orderBy('brand')->pluck('brand');

        return view('keyboards.index', [
            'keyboards' => $keyboards,
            'brands' => $brands,
        ]);
    }

    /**
     * Show the form for creating a new keyboard.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('keyboards.create'
        , [
            'options' => $this->options,
        ]
        );
    }

    /**
     * Store a newly created keyboard in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'brand'         => 'required|string|max:255',
            'switch_type'   => 'nullable|string|max:255',
            'layout'        => 'nullable|string|in:' . implode(',', $this->options['layout']),
            'connection'    => 'required|in:' . implode(',', $this->options['connection']),
            'hot_swappable' => 'nullable|boolean',
            'price'         => 'nullable|integer|min:0',
            'stock'         => 'required|integer|min:0',
            'release_date'  => 'nullable|date',
            'description'   => 'required|string',
            'image'         => 'nullable|image|max:2048',
        ]);

        $data['hot_swappable'] = (bool) ($data['hot_swappable'] ?? false);

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('keyboard-images', 'public');
        }

        Keyboard::create($data);

        return redirect()
            ->route('keyboards.index')
            ->with('status', 'Keyboard baru berhasil ditambahkan.')
            ->with('status_type', 'success');
    }

    /**
     * Display the specified keyboard detail.
     *
     * @param  \App\Keyboard  $keyboard
     * @return \Illuminate\View\View
     */
    public function show(Keyboard $keyboard)
    {
        return view('keyboards.show', [
            'keyboard' => $keyboard,
        ]);
    }

    /**
     * Show the form for editing the specified keyboard.
     *
     * @param  \App\Keyboard  $keyboard
     * @return \Illuminate\View\View
     */
    public function edit(Keyboard $keyboard)
    {
        return view('keyboards.edit', [
            'keyboard' => $keyboard,
            'options'  => $this->options,
        ]);
    }

    /**
     * Update the specified keyboard in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $keyboardId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $keyboardId)
    {
        $keyboard = Keyboard::find($keyboardId);
        if (!$keyboard) {
            return redirect()
                ->route('keyboards.index')
                ->with('status', 'Keyboard tidak ditemukan.')
                ->with('status_type', 'danger');
        }

        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'brand'         => 'required|string|max:255',
            'switch_type'   => 'nullable|string|max:255',
            'layout'        => 'nullable|string|in:' . implode(',', $this->options['layout']),
            'connection'    => 'required|in:' . implode(',', $this->options['connection']),
            'hot_swappable' => 'nullable|boolean',
            'price'         => 'nullable|integer|min:0',
            'stock'         => 'required|integer|min:0',
            'release_date'  => 'nullable|date',
            'description'   => 'required|string',
            'image'         => 'nullable|image|max:2048',
        ]);

        $keyboard->name = $validated['name'];
        $keyboard->brand = $validated['brand'];
        $keyboard->switch_type = $validated['switch_type'] ?? null;
        $keyboard->layout = $validated['layout'] ?? null;
        $keyboard->connection = $validated['connection'];
        $keyboard->hot_swappable = (bool) ($validated['hot_swappable'] ?? false);
        $keyboard->price = $validated['price'] ?? null;
        $keyboard->stock = $validated['stock'];
        $keyboard->release_date = $validated['release_date'] ?? null;
        $keyboard->description = $validated['description'];

        if ($request->hasFile('image')) {
            if ($keyboard->image_url) {
                Storage::disk('public')->delete($keyboard->image_url);
            }

            $fileName = time() . '-' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('keyboard-images', $fileName, 'public');
            $keyboard->image_url = $path;
        }

        $keyboard->save();

        return redirect()
            ->route('keyboards.index', $keyboard)
            ->with('status', 'Data keyboard berhasil diperbarui.')
            ->with('status_type', 'success');
    }

   
    public function destroy($keyboardId)
    {
        $keyboard = Keyboard::find($keyboardId);

        if (!$keyboard) {
            return redirect()
                ->route('keyboards.index')
                ->with('status', 'Keyboard tidak ditemukan.')
                ->with('status_type', 'danger');
        }

        if ($keyboard->image_url) {
            Storage::disk('public')->delete($keyboard->image_url);
        }

        $keyboard->delete();

        return redirect()
            ->route('keyboards.index')
            ->with('status', 'Keyboard berhasil dihapus.')
            ->with('status_type', 'success');
    }

    

}
