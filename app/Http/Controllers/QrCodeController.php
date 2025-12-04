<?php

namespace App\Http\Controllers;

use App\Models\QrCode;
use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('qr-codes.index');
    }

    public function getAll() {
        return QrCode::where('user_id', auth()->user()->id)->get();
    }

    public function create()
    {
        return view('qr-codes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'color' => 'required|string',
            'background_color' => 'required|string',
            'size' => 'required|integer|min:100|max:500',
            'active' => 'boolean'
        ]);

        $validated['user_id'] = auth()->id();
        $validated['active'] = $request->has('active'); // Checkbox handling

        QrCode::create($validated);

        return redirect()->route('qr-codes.index')
            ->with('success', 'QR Code creado exitosamente!');
    }

    public function show($id)
    {
        $qrCode = QrCode::findOrFail($id);
        
        // $qrCode->incrementScanCount();
        
        return view('qr-codes.show', compact('qrCode'));
    }

    public function edit(QrCode $qrCode)
    {
        return view('qr-codes.edit', compact('qrCode'));
    }

    public function update(Request $request, QrCode $qrCode)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'color' => 'nullable|string|size:7',
            'background_color' => 'nullable|string|size:7',
            'size' => 'nullable|integer|min:100|max:500',
            'active' => 'boolean'
        ]);

        $validated['active'] = $request->has('active'); // Checkbox handling

        $qrCode->update([
            'name' => $validated['name'],
            'content' => $validated['content'],
            'color' => $validated['color'] ?? '#000000',
            'background_color' => $validated['background_color'] ?? '#FFFFFF',
            'size' => $validated['size'] ?? 200,
            'active' => $validated['active']
        ]);

        return redirect()->route('qr-codes.index')
            ->with('success', 'QR code actualizado exitosamente!');
    }

    public function destroy(QrCode $qrCode)
    {
        $qrCode->delete();

        return redirect()->route('qr-codes.index')
            ->with('success', 'QR Code eliminado exitosamente!');
    }
}