<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Resources\EventResource;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::paginate(10);
        return view('dashboard-admin/event/event',['events' => $events]);
    }

    public function getAll()
    {
        $events = Event::get();
        if ($events->isEmpty()) {
            return response()->json(['message' => 'No events found.'], 404);
        }

        return EventResource::collection($events);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard-admin/event/insert-event');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'event_date' => 'required',
            'location' => 'required',
            'media_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $fileName = null;
        if ($request->hasFile('media_path')) {
        // generate random string untuk nama file
            $fileName = $this->generateRandomString();
        // ambil extension file
            $extension = $request->file('media_path')->extension();

        // Path tujuan di folder public
            $path = public_path('event-image');

        // Pastikan folder ada, jika tidak, buat foldernya
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

         // Simpan file gambar ke folder public/product-image
            $request->file('media_path')->move($path, $fileName . '.' . $extension);
        }

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'image' => $fileName ? $fileName . '.' . $extension : null,
        ]);

        return redirect('/event-admin');
    }

    public function insert(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'event_date' => 'required',
            'location' => 'required',
            'media_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $fileName = null;
        if ($request->hasFile('media_path')) {
        // generate random string untuk nama file
            $fileName = $this->generateRandomString();
        // ambil extension file
            $extension = $request->file('media_path')->extension();

        // Path tujuan di folder public
            $path = public_path('event-image');

        // Pastikan folder ada, jika tidak, buat foldernya
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

         // Simpan file gambar ke folder public/product-image
            $request->file('media_path')->move($path, $fileName . '.' . $extension);
        }

        $events = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'image' => $fileName ? $fileName . '.' . $extension : null,
        ]);

        return new EventResource($events);
    }

    function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'event not found.'], 404);
        }

        return new EventResource($event);
    }

    public function updateEvent(Request $request,$id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'event_date' => 'required',
            'location' => 'required',
            'media_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'event not found.'], 404);
        }

        $fileName = null;
        if ($request->hasFile('media_path')) {
        // generate random string untuk nama file
            $fileName = $this->generateRandomString();

        // ambil extension file
            $extension = $request->file('media_path')->extension();

        // Path tujuan di folder public
            $path = public_path('event-image');

        // Pastikan folder ada, jika tidak, buat foldernya
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

        // Simpan file gambar ke folder public/product-image
            $request->file('media_path')->move($path, $fileName . '.' . $extension);

        // Set nama file yang baru ke dalam database
            $event->image = $fileName . '.' . $extension;
        }

        $event->update($request->all());
        return new EventResource($event);

    }

    public function delete($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'event not found.'], 404);
        }

        $event->delete();

        return new EventResource($event);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('dashboard-admin/event/edit-event',['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'event_date' => 'required',
            'location' => 'required',
            'media_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $event = Event::findOrFail($id);
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->event_date = $request->input('event_date');
        $event->location = $request->input('location');

        $fileName = null;
        if ($request->hasFile('media_path')) {
        // generate random string untuk nama file
            $fileName = $this->generateRandomString();

        // ambil extension file
            $extension = $request->file('media_path')->extension();

        // Path tujuan di folder public
            $path = public_path('event-image');

        // Pastikan folder ada, jika tidak, buat foldernya
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

        // Simpan file gambar ke folder public/product-image
            $request->file('media_path')->move($path, $fileName . '.' . $extension);

        // Set nama file yang baru ke dalam database
            $event->image = $fileName . '.' . $extension;
        }

        $event->save();

        return redirect('/event-admin');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->image) {
            $imagePath = public_path('event-image/' . $event->image);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $event->delete();
        return redirect('/event-admin')->with('success', 'Event deleted successfully!');
    }
}
