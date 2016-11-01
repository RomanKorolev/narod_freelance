<h2><?php echo $title; ?></h2>

<?php foreach ($users as $user_item): ?>

        <h3><?php echo $user_item['title']; ?></h3>
        <div class="main">
                <?php echo $user_item['text']; ?>
        </div>
        <p><a href="<?php echo site_url('user/'.$$user_item['slug']); ?>">View article</a></p>

<?php endforeach; ?>
