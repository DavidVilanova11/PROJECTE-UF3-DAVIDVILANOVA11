<?php
include_once("App/Core/Controller.php");
include_once("App/Models/Usuari.php");
include_once("App/Models/Extinguida.php");

class InitialData extends Controller
{

    public function charge()
    {

        $usuariModel = new Usuari();
        if ($usuariModel->getAll() == null) {
            $usuari = array(
                "id" => $_SESSION['id_usuari']++,
                "email_usuari" => "admin@gmail.com",
                "nom_usuari" => "Admin",
                "usuari_usuari" => "admin",
                "contrasenya_usuari" => "admin",
                "admin" => true,
                "token" => "token",
                "verificat" => true
            );

            $usuariModel->create($usuari);

            $extinguidaModel = new Extinguida();


            if ($extinguidaModel->getAll() == null) {
                $extinguida = array(
                    "id" => $_SESSION['id_extinguida']++,
                    "num_extinguida" => "1",
                    "familia_extinguida" => "Apodidae",
                    "nom_extinguida" => "Acridotheres tristis",
                    "imatge_extinguida" => "gavia.jpg",
                    "video_extinguida" => "gavia.mp4",
                    "id_usuari" => "1"
                );

                $extinguidaModel->create($extinguida);

                $extinguida = array(
                    "id" => $_SESSION['id_extinguida']++,
                    "num_extinguida" => "7",
                    "familia_extinguida" => "Accipitridae",
                    "nom_extinguida" => "Accipiter gentilis",
                    "imatge_extinguida" => "Bird-Friendly-City.jpg",
                    "video_extinguida" => null,
                    "id_usuari" => "1"
                );

                $extinguidaModel->create($extinguida);

                $extinguida = array(
                    "id" => $_SESSION['id_extinguida']++,
                    "num_extinguida" => "33",
                    "familia_extinguida" => "Anatidae",
                    "nom_extinguida" => "Nix",
                    "imatge_extinguida" => "Acridotheres tristis.avif",
                    "video_extinguida" => null,
                    "id_usuari" => "1"
                );

                $extinguidaModel->create($extinguida);
            }
        }
    }
}
