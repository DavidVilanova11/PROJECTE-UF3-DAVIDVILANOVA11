<?php
include_once("App/Core/Controller.php");
include_once("App/Models/Usuari.php");
include_once("App/Models/Recuperada.php");

class InitialData extends Controller
{

    public function charge()
    {

        $usuariModel = new Usuari();
        if ($usuariModel->getAll() == null) {
            $usuari = array(
                //"id" => $_SESSION['id_usuari']++,
                "email_usuari" => "admin@gmail.com",
                "nom_usuari" => "Admin",
                "usuari_usuari" => "admin",
                "contrasenya_usuari" => "admin",
                "admin" => true,
                "token" => "token",
                "verificat" => true
            );

            $usuariModel->create($usuari);

            $recuperadaModel = new Recuperada();


            if ($recuperadaModel->getAll() == null) {
                $recuperada = array(
                    //"id" => $_SESSION['id_recuperada']++,
                    "num_recuperada" => "1",
                    "familia_recuperada" => "Apodidae",
                    "nom_recuperada" => "Acridotheres tristis",
                    "imatge_recuperada" => "gavia.jpg",
                    "video_recuperada" => "gavia.mp4",
                    "id_usuari" => "1"
                );

                $recuperadaModel->create($recuperada);

                $recuperada = array(
                    //"id" => $_SESSION['id_recuperada']++,
                    "num_recuperada" => "7",
                    "familia_recuperada" => "Accipitridae",
                    "nom_recuperada" => "Accipiter gentilis",
                    "imatge_recuperada" => "Bird-Friendly-City.jpg",
                    "video_recuperada" => null,
                    "id_usuari" => "1"
                );

                $recuperadaModel->create($recuperada);

                $recuperada = array(
                    //"id" => $_SESSION['id_recuperada']++,
                    "num_recuperada" => "33",
                    "familia_recuperada" => "Anatidae",
                    "nom_recuperada" => "Nix",
                    "imatge_recuperada" => "Acridotheres tristis.avif",
                    "video_recuperada" => null,
                    "id_usuari" => "1"
                );

                $recuperadaModel->create($recuperada);
            }
        }
    }
}
