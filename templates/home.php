<?php

/**
 *  @var FormBuilder $form
 * @var HomeController $user
 */

use App\Controller\HomeController;
use Core\Form\FormBuilder;

?>

<div class="mb-4">
    <header class="container  px-4 px-lg-5" >
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading col-md-10 col-lg-8 col-xl-7" style="    display: inline;">
                        <h1 style="margin-bottom: 1.5rem">
                           <?php echo 'Welcome to my blog '.$user?->getPseudo() ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
<!-- Main Content-->
<main class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">

                <p>
                    Bienvenu !
                    Eius praesentium recusandae illo eaque architecto error, repellendus iusto reprehenderit, doloribus, minus sunt.
                    Numquam at quae voluptatum in officia voluptas voluptatibus, minus!
                </p>

                <hr class="my-4" />
                <h3 class="text-center" style="text-decoration: underline;">
                    <a class="btn btn-primary" role="button" href="assets/downloads/" download="IMAMOSx95.pdf">Téléchargez mon CV !</a>
                </h3>

                <hr class="my-4" />
                <p>Vous souhaitez me contacter ? Remplissez le formulaire ci-dessous, et à très vite !</p>
            </div>
        </div>
    </div>
</main>
<div class="row mt-5 justify-content-md-center" id="contact">
    <div class="col-6">
        <h2 class="text-center">Send me a message</h2>

        <?php echo $form->start(); ?>
        <?php echo $form->row('username'); ?>
        <?php echo $form->row('email'); ?>
        <?php echo $form->row('subject'); ?>
        <button type="submit"  value="submit" class="btn btn-primary mt-4 me-lg-4">Envoyer</button>
        <?php echo $form->end(); ?>
    </div>
</div>
