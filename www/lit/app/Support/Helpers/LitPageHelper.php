<?php

namespace Lit\Support\Helpers;

class LitPageHelper extends LitHelper
{
    public function __construct()
    {

    }

    public function actionSelectOptions($decorate = null)
    {
        // $decorate = '<span class="badge badge-secondary">{option}</span>';
        $options = [
            null => '-',
        ];
        foreach ((array) config('site.config.page-actions') as $action => $route) {
            if (!is_null($decorate)) {
                $options[$action] = str_replace('{option}', __("site::routes.$route"), $decorate);
            } else {
                $options[$action] = __("site::routes.$route");
            }
        }
        return $options;
    }

    public function titleTagSelectOptions()
    {
        return [
            'div' => 'tytuł',
            'h1' => 'tytuł jako tag h1',
            '-' => 'ukryty',
        ];
    }

    public function textHint()
    {
        return [
            'title' => 'KODY WYWOŁANIA',
            'body' => '
                <b>KODY WYWOŁANIA:</b> (Wklej jako zwykły tekst Ctrl + Shift + V)<br><br>

                [HR] - pozioma linia<br>
                <br>
                <b>BLOKI:</b><br>
                [BLOCK]<br>
                To jest treść paragrafu [H2]to jest ukryty nagłówek h2[/H2].<br>
                [/BLOCK]<br>
                <br>
                <b>KOLUMNY</b>:<br>
                [COL.1]<br>
                Kolumna nr 1<br>
                [COL.2]<br>
                Kolumna nr 2<br>
                [/COL]<br>
                <br>
                <b>KOLUMNY</b>:<br>
                [COL.LEFT]<br>
                Kolumna lewa<br>
                [COL.RIGHT]<br>
                Kolumna prawa<br>
                [/COL]<br>
                <br>
                <b>KOLUMNY BOOTSTRAP (SUMA = 12):</b><br>
                [COL.START.2]<br>
                Kolumna szerokość: 2<br>
                [COL.NEXT.5]<br>
                Kolumna szerokość: 5<br>
                [COL.NEXT.5]<br>
                Kolumna szerokość: 5<br>
                [/COL]<br>
            ',
        ];
    }

    public function imagesHelp()
    {
        return [
            'title' => 'KODY WYWOŁANIA',
            'body' => '
                <b>KODY WYWOŁANIA:</b> (Wklej jako zwykły tekst Ctrl + Shift + V)<br><br>
                [IMAGEGALLERY] - galeria<br>
                [IMAGEMINIATURES] - miniaturki<br><br>
                [IMAGES] - wszystkie zdjęcia (max po 4 w linii)<br>
                [IMAGES.3] - wszystkie zdjęcia (po 3 w linii)<br>
                [IMAGES.5] - wszystkie zdjęcia (po 5 w linii)<br><br>
                [IMAGE.1] lub [IMG.1] - zdjęcie nr 1<br>
                [IMAGE.2] lub [IMG.2] - zdjęcie nr 2<br><br>
                [IMAGE.1..L..1/3] - zdjęcie nr 1 lewa krawędź 1/3 szerokości<br>
                [IMAGE.2..C..1/2] - zdjęcie nr 2 centrowany 1/2 szerokości<br>
                [IMAGE.3..R..1/3] - zdjęcie nr 3 prawa krawędź 1/3 szerokości<br><br>
                [IMAGE.1..1/3][IMAGE.2..1/3][IMAGE.3..1/3] - trzy zdjęcia w rzędzie<br>
                [IMAGE.1..1/4][IMAGE.2..1/4][IMAGE.3..1/4][IMAGE.4..1/4] - cztery zdjęcia w rzędzie<br><br>
                [IMAGES..3][IMG.1][IMG.2][IMG.3][/IMAGES] -  blok trzech zdjęć w rzędzie<br>
                [IMAGES..4][IMG.1][IMG.2][IMG.3][IMG.4][/IMAGES] -  blok czterech zdjęć w rzędzie<br>
            ',
        ];
    }

    public function photoLinksHint()
    {
        return [
            'title' => 'KODY WYWOŁANIA',
            'body' => '
                <b>KODY WYWOŁANIA:</b> (Wklej jako zwykły tekst Ctrl + Shift + V)<br><br>
                [BUTTONS]<br>
            ',
        ];
    }

    public function galleriesHint()
    {
        return [
            'title' => 'KODY WYWOŁANIA',
            'body' => '
                Dodane galerie pojawią się pod treścią strony.<br><br>
                Galerie można również wywoływać w treści za pomocą poniższych kodów.<br><br>
                <b>KODY WYWOŁANIA:</b> (Wklej jako zwykły tekst Ctrl + Shift + V)<br><br>
                [GALLERY.1] - Galeria id 1<br>
                [GALLERY.2] - Galeria id 2<br><br>
                [GALLERYPHOTOS.1] - Zdjęcia galerii id 1 (galeria bez tytułu i opsiu)<br>
                [GALLERYPHOTOS.2] - Zdjęcia galerii id 1 (galeria bez tytułu i opsiu)<br><br>
                [GALLERIES] - Wszsytkie galerie<br>
                [GALLERY] - Wszsytkie galerie<br>
            ',
        ];
    }
}
