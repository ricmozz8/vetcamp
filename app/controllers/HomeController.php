<?php
require_once 'Controller.php';
require_once 'app/models/Session.php';
require_once 'app/models/LimitDate.php';

class HomeController extends Controller
{

    /**
     * This renders the index view which shows the limit dates and the current sessions.
     *
     * @note If this is the first time the app is setting up, the limit dates need to be changed on either
     * the database or the admin panel
     * @return void
     */
    public static function index()
    {
        // Validate that the limit dates exist
        try {
            $limitDates = LimitDate::find(1);
        } catch (ModelNotFoundException $e) {
            // if they don't exist, create a temporary one with today as the start and end date.
            $limitDates = LimitDate::create(['id_date' => 1, 'start_date' => date('Y-m-d'), 'end_date' => date('Y-m-d')]);
        }

        $sessions = Session::all();

        // default images
        $defaultImages = [
            1 => 'img/cow-2.jpeg',
            2 => 'img/doggo-checkup-2.jpeg',
            3 => 'img/microscopes-2.jpeg',
            4 => 'img/group-looking-away-2.jpeg',
        ];

        $customImages = [];

        for ($i = 1; $i <= 4; $i++) {
            // resources/assets/img/homePage/
            $pathToAssets = realpath(__DIR__ . '/../../resources/assets/img/homePage');
            
            if ($pathToAssets === false) {
                $customImages[$i] = $defaultImages[$i];
                continue;
            }

            // search picture 
            $pattern = $pathToAssets . "/picture{$i}.*";
            $files = glob($pattern);

            if (!empty($files)) {
                $extension = pathinfo($files[0], PATHINFO_EXTENSION);
                $customImages[$i] = 'img/homePage/picture' . $i . '.' . $extension;
            } else {
                $customImages[$i] = $defaultImages[$i];
            }
        }
        // For test path
        //dd($customImages);

        // your index view here
        render_view('home', ['sessions' => $sessions, 'limit_dates' => $limitDates, 'customImages' => $customImages], 'Solicita para el Vetcamp ' . date('Y'));
    }

    // define your other methods here

    public static function branding()
    {
        render_view('branding', [], 'Marca');
    }

    public static function credits()
    {
        render_view('credits', [], 'Créditos');
    }
}
