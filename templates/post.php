<?php

/**
 * @var PostController $post
 * @var PostController $data
 * @var FormBuilder $form
 * @var array $errors
 * @var User $user
 */


use App\Controller\PostController;
use App\Model\User;
use Core\Form\FormBuilder;

?>


<h1>Le post</h1>
<!-- Post Content -->
<article class="mb-4 container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="card border-primary bg-light  mb-auto justify-content-between"
                 style="max-width: 80rem; margin-top: 3rem">
                <div class="card-header"><?= $post->getTitle(); ?></div>
                <div class="card-body">
                    <h4 class="card-title"><?= $post->getHead(); ?></h4>
                    <p class="card-text"><?= $post->getContent(); ?></p>
                </div>
                <div class="card-footer text-muted">
                    Par <a href="#!"><?= $post->getAuthor(); ?></a> Le <?= $post->getCreatedAt()->format('d/m/Y H:i') ?>
                    <?php if ($post->getUpdatedAt() !== null) { ?>
                        <small>Modifié le </small><span><?= $post->getUpdatedAt() ?></span>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</article>

<div class="mb-4 container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <?php if (isset($user)) { ?>
                <hr class="my-4"/>
                <h4> donnez-nous votre avis :</h4>
                <br/>
                <form id="commentForm" action="/comment/add" method="post">
                    <div class="form-group">
                        <div class="mb-0">
                                <textarea class="form-control" name="commentContent" rows="3"
                                          placeholder="Votre message"></textarea>
                            <small class="form-text text-muted"><em>Le commentaire sera validé par un modérateur
                                    avant d'apparaître.</em></small>
                        </div>
                    </div>
                    <input type="hidden" name="postId" value="<?php echo $data['postId'] ?>" >
                    <br/>
                    <div class="row justify-content-center">
                        <input type="submit" id="submitButton"
                               class="col-md-3 col-sm-6 btn btn-primary text-uppercase rounded" value='Envoyer'
                               onclick=" alert('Votre Commantaire a été bien transmis');">
                    </div>
                </form>

            <?php } ?>

            <hr class="my-4"/>
            <h3>Commentaires publiés</h3>
            <hr class="my-4"/>
            <ul>

                <?php foreach ($data['comments'] as $comment) : ?>
                    <?php if ($user?->getStatus() == 'admin' && $comment->getStatus() == 'not_approved') { ?>
                        <div class="card bg-warning  " style="margin-top: 1.5rem">
                            <div class="card-header">Non Valider par l'admin</div>
                            <div class="card-body">
                                <h4 class="card-title">Par <?php echo $comment->getAuthor(); ?></h4>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    le <?php echo $comment->getCreatedAt(); ?> </h6>
                                <p class="card-text"> <?php echo $comment->getContent(); ?> </p>
                            </div>
                            <div class="form-buttons" style="display: flex; justify-content: space-around; margin-bottom: 0.5rem;}">
                                <form action="/comment/approve" method="post">
                                    <input type="hidden" name="postId" value="<?php echo $data['postId'] ?>"/>
                                    <input type="hidden" name="commentId" value="<?php echo $comment->getId(); ?>"/>
                                    <input class="btn btn-success rounded"
                                           type="submit" value="Approuver"/>
                                </form>
                                <form action="/comment/delete" method="post" >
                                    <input type="hidden" name="postId" value="<?php echo $data['postId'] ?>"/>
                                    <input type="hidden" name="commentId" value="<?php echo $comment->getId(); ?>"/>
                                    <input class="btn btn-danger rounded"
                                           type="submit" value="Supprimer"
                                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?');"/>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($comment->getStatus() == 'approved') { ?>
                        <div class="card " style="margin-top: 1.5rem">
                            <div class="card-body">
                                <h4 class="card-title">Par <?php echo $comment->getAuthor(); ?></h4>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    le <?php echo $comment->getCreatedAt(); ?> </h6>
                                <p class="card-text"> <?php echo $comment->getContent(); ?> </p>
                            </div>
                        </div>
                    <?php } ?>

                <?php endforeach; ?>

            </ul>
        </div>
    </div>
</div>
