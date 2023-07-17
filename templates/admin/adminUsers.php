<?php

/**
 * @var AdminController $usersLastname
 * @var AdminController $usersPseudo
 * @var AdminController $usersEmail
 * @var AdminController $usersFirstname
 * @var AdminController $users
 * @var AdminController $data
 */

use App\Controller\Admin\AdminController;

?>
<div>
    <h1>Hello Admin</h1>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Pseudo</th>
            <th scope="col">Prénom</th>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">action</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($data['users'] as $user) :?>
            <?php $banned = $user->getStatus()=='banned' ?>
            <?php $text = $banned ? 'Banni' : 'Visiteur' ?>
            <?php $btnClass = $banned ? 'btn-outline-success' : 'btn-outline-danger' ?>
            <?php $btnText = $banned ? 'Débannir' : 'Bannir' ?>
            <?php $statusValue = $banned ? 'visitor' : 'banned' ?>
            <?php  ?>
        <form action="/admin/userstatus" method='post'>
            <tr class="table-success">
                <th><input type="hidden" name="userPseudo" value="<?php echo $user->getPseudo(); ?>"/><?php echo $user->getPseudo(); ?></th>
                <td> <?php echo $user->getFirstname(); ?></td>
                <td> <?php echo $user->getLastname(); ?></td>
                <td> <?php echo $user->getEmail(); ?></td>
               <input type="hidden" name="userStatus" value="<?php echo $statusValue?>"/> <?php echo $statusValue;?>
                <td><input type="submit" class="btn <?php echo $btnClass?>" value="<?php echo $btnText ?>"
                    onclick="return  confirm('Êtes-vous sûr de vouloir [<?php echo $btnText ?>] <?php echo $user->getPseudo(); ?> ?'); "/></td>
            </tr>
        </form>
        <?php endforeach;?>
        </tbody>
    </table>


</div>
