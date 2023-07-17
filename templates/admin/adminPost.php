<?php

/**
 * @var FormBuilder $form
 * @var array $data
 * @var Post $post
 */

use App\Model\Post;
use Core\Form\FormBuilder;

?>

<h1><?php echo $data['title'] ?></h1>

<!-- Main Content-->
<main class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">

            <?php $data['post'] = $post ?>
            <?php $title = $post ? $post->getTitle() : 'Titre' ?>
            <?php $head = $post ? $post->getHead() : 'Chapo' ?>
            <?php $content = $post ? $post->getContent() : 'Contenu du Post' ?>
            <form class="justify-content-center" action="/admin/articles" method="post">
                <input type="hidden" name="postId" value="<?php echo $post ? $post->getId() : 0 ?>" />
                <input class="form-control" name="title" type="text" placeholder="<?php echo $title ?>" value="<?php echo $post ? $title : '' ?>"/>
                <textarea class="form-control" name="head" placeholder="<?php echo $head?>" style="height: 6rem"><?php echo $post ? $head : ''?></textarea>
                <textarea class="form-control" name="content" placeholder="<?php echo $content?>" style="height: 18rem"><?php echo $post ? $content : ''?></textarea>
                <input type="submit" class="btn btn-primary text-uppercase" value='Enregistrer'>
            </form>
        </div>
    </div>
</main>

