<?php
/* Template Name: Persone
 *
 * didattica template file
 *
 * @package Design_Scuole_Italia
 */
global $post;
get_header();

function display_users_by_role($role, $title) {
    $args = array(
        'meta_key' => 'last_name',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => '_dsi_persona_ruolo_scuola',
                'value' => $role,
                'compare' => '='
            )
        )
    );
    $users = get_users($args);
    $number_of_users = count($users);
    if ($number_of_users > 0) {
        ?>
        <section class="section mt-4">
            <div class="container">
                <div class="title-section mb-5">
                <h2 class="h4"><?php echo $title; ?></h2>
                </div>
            <div class="row variable-gutters">
            <?php
                foreach ($users as $user) {
                    global $autore; // Assicura che sia globale
                    $autore = get_user_by("ID", $user->ID); // Aggiorna con i dettagli dell'utente corrente
                    get_template_part("template-parts/autore/card-persona");
                }
            ?>
            </div>      
        </section>  
        <?php
    }
}

?>

<main id="main-container" class="main-container redbrown">
    
    <?php get_template_part("template-parts/common/breadcrumb"); ?>
    
    <?php get_template_part("template-parts/hero/persone"); ?>

    <?php display_users_by_role('dirigente', 'Dirigente Scolastico'); ?>
    <?php display_users_by_role('docente', 'Personale docente'); ?>
    <?php display_users_by_role('personaleata', 'Personale non docente'); ?>

</main>

<?php
get_footer();
