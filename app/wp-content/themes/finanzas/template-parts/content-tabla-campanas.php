<?php $temp_query = $wp_query; ?>
<!-- Do stuff... -->

<?php query_posts( 'category_name=campana&posts_per_page=10' ); ?>

<?php while ( have_posts() ) : the_post(); ?>
    <tr>
        <td><small>Holi1</small></td>
        <td><small>Holi2</small></td>
        <td><small>Holi3</small></td>
    </tr>
<?php endwhile; ?>