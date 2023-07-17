<?php

/**
 * @var FormBuilder $form
 * @var array $data
 */

use Core\Form\FormBuilder;

?>

<?php if (!isset($_POST) && $data['mail_sent'] === true) : ?>

    <div class="justify-content-center text-center">
        Merci pour votre message, <strong><?= $data['name'] ?></strong> ! Il sera lu rapidement.<br/><br/>
        <a class="row justify-content-center" href="/">
            <button class="col-md-7 col-lg-7 col-xl-7 btn btn-primary">Retourner à l'accueil</button>
        </a>
    </div>

<?php else: ?>

    <hr class="my-4"/>
    <div class="justify-content-center text-center">
        Remplissez le formulaire ci-dessous pour me contacter, je reviendrai vers vous dans les plus brefs
        délais.<br/><br/>
        <small class="text-muted">À très vite !</small>
    </div>
    <?php echo $form->start(); ?>
    <?php echo $form->row('username'); ?>
    <?php echo $form->row('email'); ?>
    <?php echo $form->row('subject'); ?>

    <button type="submit" value="submit" class="btn btn-primary mt-4 me-lg-4">Valider</button>
    <?php echo $form->end(); ?>

<?php endif; ?>
