<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DownloadApp extends Controller
{
    public function index() {
        $filename = 'app-release.apk';
        $file_path = public_path('app_download') . "/" . $filename;
        $headers = array(
            'Content-Type: application/vnd.android.package-archive',
            'Content-Disposition: attachment; filename='.$filename,
        );

        if ( file_exists( $file_path ) ) {
            // Send Download
            return \Response::download( $file_path, $filename, $headers );
        } else {
            // Error
            exit( 'Requested file does not exist on our server!' );
        }
    }
}
