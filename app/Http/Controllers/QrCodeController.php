<?php

namespace App\Http\Controllers;

use App\Models\QrCode;
use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function index()
    {
        $qrCodes = QrCode::latest()->get();
        return view('qr-codes.index', compact('qrCodes'));
    }

    public function create()
    {
        return view('qr-codes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:url,text,wifi,email,contact',
            'content' => 'required|string',
            'color' => 'required|string',
            'background_color' => 'required|string',
            'size' => 'required|integer|min:100|max:500'
        ]);

        QrCode::create($request->all());

        return redirect()->route('qr-codes.index')
            ->with('success', 'QR Code creado exitosamente!');
    }

    public function show($id)
    {
        $qrCode = QrCode::findOrFail($id);
        
        // Incrementar contador de escaneos cuando se visualiza
        $qrCode->incrementScanCount();
        
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
            'type' => 'required|in:url,text,email,wifi,vcard,sms,phone',
            'content' => 'required|string',
            'color' => 'nullable|string|size:7',
            'background_color' => 'nullable|string|size:7',
            'size' => 'nullable|integer|min:100|max:500',
            'is_active' => 'boolean'
        ]);

        // Procesar el contenido según el tipo
        $contentData = $validated['content'];
        if (in_array($validated['type'], ['wifi', 'vcard', 'sms'])) {
            try {
                $contentData = json_decode($contentData, true, 512, JSON_THROW_ON_ERROR);
            } catch (\JsonException $e) {
                // Si no es JSON válido, mantener como string
            }
        }

        $qrCode->update([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'content' => $contentData,
            'color' => $validated['color'] ?? '#000000',
            'background_color' => $validated['background_color'] ?? '#FFFFFF',
            'size' => $validated['size'] ?? 200,
            'is_active' => $validated['is_active'] ?? false
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