<?php
include_once("App/Core/Controller.php");
include_once("App/Models/Entrenador.php");
include_once("App/Models/Ocell.php");

class InitialData extends Controller
{

    public function charge()
    {

        $entrenadorModel = new Entrenador();
        if ($entrenadorModel->getAll() == null) {
            $entrenador = array(
                "id" => $_SESSION['id_entrenador']++,
                "email_entrenador" => "admin@gmail.com",
                "nom_entrenador" => "Admin",
                "usuari_entrenador" => "admin",
                "contrasenya_entrenador" => "admin",
                "admin" => true,
                "token" => "token",
                "verificat" => true
            );

            $entrenadorModel->create($entrenador);

            $ocellModel = new Ocell();


            if ($ocellModel->getAll() == null) {
                $ocell = array(
                    "id" => $_SESSION['id_ocell']++,
                    "num_ocell" => "1",
                    "familia_ocell" => "Apodidae",
                    "nom_ocell" => "Acridotheres tristis",
                    "imatge_ocell" => "gavia.jpg",
                    "video_ocell" => "gavia.mp4",
                    "id_entrenador" => "1"
                );

                $ocellModel->create($ocell);

                $ocell = array(
                    "id" => $_SESSION['id_ocell']++,
                    "num_ocell" => "7",
                    "familia_ocell" => "Accipitridae",
                    "nom_ocell" => "Accipiter gentilis",
                    "imatge_ocell" => "Bird-Friendly-City.jpg",
                    "video_ocell" => null,
                    "id_entrenador" => "1"
                );

                $ocellModel->create($ocell);

                $ocell = array(
                    "id" => $_SESSION['id_ocell']++,
                    "num_ocell" => "33",
                    "familia_ocell" => "Anatidae",
                    "nom_ocell" => "Nix",
                    "imatge_ocell" => "Acridotheres tristis.avif",
                    "video_ocell" => null,
                    "id_entrenador" => "1"
                );

                $ocellModel->create($ocell);
            }
        }
    }
}
