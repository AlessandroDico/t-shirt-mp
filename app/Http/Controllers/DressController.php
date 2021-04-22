<?php

namespace App\Http\Controllers;

use App\Dress;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dresses = Dress::all();
        $data = [
            'dresses' => $dresses,
        ];
        // dd($data);
        return view('guest.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('guest.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // controllo che l'immagine sia in base64
        if (base64_decode($request->image, true)) {

            $img = imagecreatefromstring(base64_decode($request->image));
            imagepng($img, 'myimage.png');
            $imgMime = getimagesize('myimage.png');

            // se l'immagine è valida sia in formato base64 che come estensione faccio la validazione backend
            if (($img) && ($imgMime['mime'] == 'image/png')) {
                // dd('correct');
                $request->validate([
                    'name' => 'required|max:50|min:6',
                    'image' => 'required',
                ]);
                //se passo la validazione salvo nel DB nome e immagine
                $data = $request->all();
                $newDress = new Dress();
                $newDress->name = $data['name'];
                $newDress->image = $data['image'];

                // genero lo slug prendendo il titolo questa volta dal form
                $slug = Str::slug($newDress->name, '-');

                $slugEditable = $slug;
                $currentSlug = Dress::where('slug', $slug)->first();
                $contatore = 1;
                while($currentSlug) {
                    $slug = $slugEditable . '-' . $contatore;
                    $contatore++;
                    $currentSlug = Dress::where('slug', $slug)->first();
                }

                $newDress->slug = $slug;


                $newDress->save();

                //se non esiste creo la cartella per le immagini del progetto corrente
                if (!file_exists('./img/projects/' . $newDress->slug)) {
                    mkdir('./img/projects/' . $newDress->slug, 0777, true);
                }

                $link= 'data:image/png;base64,' . $newDress->image;
                $destdir = './img/projects/' . $newDress->slug;
                $newImg = file_get_contents($link);
                file_put_contents('./img/projects/' . $newDress->slug . '/full.jpeg', $newImg);
                file_put_contents('./img/projects/' . $newDress->slug . '/mid.jpeg', $newImg);
                file_put_contents('./img/projects/' . $newDress->slug . '/thumbnail.jpeg', $newImg);


                // se non esiste creo una dopia della cartella per le immagini con il watermark
                if (!file_exists('./img/projects_watermarked/' . $newDress->slug)) {
                    mkdir('./img/projects_watermarked/' . $newDress->slug, 0777, true);
                }
                $source = './img/projects/' . $newDress->slug;
                $destination = './img/projects_watermarked/' . $newDress->slug;

                $watermark = imagecreatefrompng('./img/watermark/watermark.png');

                $margin_right = 40;
                $margin_bottom = 10;

                $sx = imagesx($watermark);
                $sy = imagesy($watermark);
                $images = array_diff(scandir($source), array('..','.'));

                foreach ($images as $image) {
                    $img = imagecreatefrompng($source . '/' . $image);
                    imagecopy($img, $watermark, imagesx($img) -$sx - $margin_right, imagesy($img) - $sy - $margin_bottom, 0, 0, $sx, $sy);
                    $i = imagejpeg($img, $destination . '/' . $image, 100);
                }


// in questo punto dopo che ho le cartelle con le immagini ridimensiono le immagini mid e thumbnail
                if (!function_exists('resize_image')) {
                    function resize_image($file, $w, $h) {
                       list($width, $height) = getimagesize($file);
                       $src = imagecreatefromjpeg($file);
                       $dst = imagecreatetruecolor($w, $h);
                       imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
                       return $dst;
                    }
                    //

                    $imgMid = resize_image('./img/projects_watermarked/'. $newDress->slug . '/mid.jpeg', 250, 303);
                    imagejpeg($imgMid, './img/projects_watermarked/'. $newDress->slug . '/mid.jpeg');

                    $imgThumbnail = resize_image('./img/projects_watermarked/'. $newDress->slug . '/thumbnail.jpeg', 150, 181);
                    imagejpeg($imgThumbnail, './img/projects_watermarked/'. $newDress->slug . '/thumbnail.jpeg');
                };
                //-----------------------
                return redirect()->route('dress.index')->withSuccess('Salvataggio avvenuto correttamente');
            }
        } else {
            return redirect()->route('dress.create')->withErrors('Errore: immagine non valida');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dress  $dress
     * @return \Illuminate\Http\Response
     */
    public function show(Dress $dress)
    {
        return view('guest.show', compact('dress'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dress  $dress
     * @return \Illuminate\Http\Response
     */
    public function edit(Dress $dress)
    {
        // dd(base64_encode($dress->image));
        // dd($dress);
        // $img = imagecreatefromstring(base64_encode($dress->image));
        $data = [
            'dress' => $dress,
            // 'encode' => base64_encode($dress->image),
        ];
        return view('guest.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dress  $dress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dress $dress)
    {
        $data = $request->all();
        // dd($data);
        // controllo che l'immagine sia in base64
        if (base64_decode($request->image, true)) {

            $img = imagecreatefromstring(base64_decode($request->image));
            imagepng($img, 'myimage.png');
            $imgMime = getimagesize('myimage.png');

            // se l'immagine è valida sia in formato base64 che come estensione faccio la validazione backend
            if (($img) && ($imgMime['mime'] == 'image/png')) {
                // dd('correct');
                $request->validate([
                    'name' => 'required|max:50|min:6',
                    'image' => 'required',
                ]);

                //se il nome è cambiato devo cambiare lo slug
                if ($data['name'] != $dress->name) {
                    // dd($data['slug']);
                    $slug = Str::slug($data['name'], '-');

                    $slugEditable = $slug;
                    $currentSlug = Dress::where('slug', $slug)->first();
                    $contatore = 1;
                    while($currentSlug) {
                        $slug = $slugEditable . '-' . $contatore;
                        $contatore++;
                        $currentSlug = Dress::where('slug', $slug)->first();
                    }

                    $data['slug'] = $slug;
                }
                //se passo la validazione aggiorno nel DB nome e immagine
                $dress->update($data);


                return redirect()->route('dress.index')->withSuccess('Modifica avvenuta correttamente');
            }
        } else {
            dd($data);

            return redirect()->route('dress.edit')->withErrors('Errore: immagine non valida');

        }


        return redirect()->route('guest.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dress  $dress
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dress $dress)
    {
        //elimino anche le rispettive cartelle con le immagini
        if (file_exists('./img/projects/' . $dress->slug)) {
            array_map('unlink', glob('./img/projects/' . $dress->slug . '/*.jpeg'));
            rmdir('./img/projects/' . $dress->slug);
        }
        if (file_exists('./img/projects_watermarked/' . $dress->slug)) {
            array_map('unlink', glob('./img/projects_watermarked/' . $dress->slug . '/*.jpeg'));
            rmdir('./img/projects_watermarked/' . $dress->slug);
        }
        $dress->delete();
        return redirect()->route('dress.index')->withSuccess('Elemento eliminato correttamente');

    }
}
