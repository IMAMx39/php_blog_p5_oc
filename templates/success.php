<?php
/**
 * @var array $data
 */
?>


<main class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="alert alert-success text-center">
                <p class="justify-content-center text-center">
                    Merci pour votre message, <strong><?= $data['name'] ?></strong> ! Il sera lu rapidement.<br/><br/>

                </p>
                </div>

                <hr class="my-4" />

                <a class="row justify-content-center" href="/">
                    <button class="col-md-7 col-lg-7 col-xl-7 btn btn-primary">Retourner à l'accueil</button>
                </a>

            </div>
        </div>
    </div>
</main>

