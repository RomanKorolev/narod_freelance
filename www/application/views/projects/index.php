<h2><?php echo $title; ?></h2>

<?php foreach ($projects as $project_item): ?>

        <h3><?php echo $project_item['title']; ?></h3>
        <div class="main">
                <?php echo $project_item['text']; ?>
        </div>
        <p><a href="<?php echo site_url('projects/'.$project_item['id']); ?>">View article</a></p>

<?php endforeach; ?>
