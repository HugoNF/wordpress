<!--
Plugin Name: PlugBDD
Description: Plugin de création de BDD
Version: 0.0.1.1
Author: Hugo Ratel-->
<?php

class Plugbdd
{
    
public function pluginActivation() {
    global $wpdb;


    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."USER (
        USER_id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(45) NULL,
        surname VARCHAR(45) NULL,
        picture VARCHAR(45) NULL,
        DOB DATETIME NULL,
        email VARCHAR(255) NULL,
        password VARCHAR(200) NULL,
        PRIMARY KEY (USER_id))$charset_collate";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

          dbDelta( $sql );


    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."COMPETENCES (
        id INT NOT NULL,
        NAME VARCHAR(45) NULL,
        PRIMARY KEY (id))$charset_collate";
          dbDelta( $sql );


    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."LEVEL (
        id INT NOT NULL AUTO_INCREMENT,
        level INT NULL DEFAULT 0,
        USER_USER_id INT NOT NULL,
        COMPETENCES_id INT NOT NULL,
        PRIMARY KEY (id, USER_USER_id, COMPETENCES_id)),
        INDEX fk_LEVEL_USER1_idx (USER_USER_id ASC) VISIBLE,
        INDEX fk_LEVEL_COMPETENCES1_idx (COMPETENCES_id ASC) VISIBLE,
        CONSTRAINT fk_LEVEL_USER1
        FOREIGN KEY (USER_USER_id)
        REFERENCES mydb.USER (USER_id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
        CONSTRAINT fk_LEVEL_COMPETENCES1
        FOREIGN KEY (COMPETENCES_id)
        REFERENCES mydb.COMPETENCES (id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)$charset_collate";

          dbDelta( $sql );


    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."REALISATIONS (
        id INT NOT NULL AUTO_INCREMENT,
        BEGIN DATETIME NULL,
        END DATETIME NULL,
        description LONGTEXT NULL,
        PRIMARY KEY (id))$charset_collate";

              dbDelta( $sql );         

    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."USER_PICTURE (
        ID INT NOT NULL,
        FILE_NAME VARCHAR(45) NULL,
        USER_USER_id INT NOT NULL,
        PRIMARY KEY (id, USER_USER_id),
        INDEX fk_USER_PICTURE_USER1_idx (USER_USER_id ASC) VISIBLE,
        CONSTRAINT fk_USER_PICTURE_USER1
        FOREIGN KEY (USER_USER_id)
        REFERENCES mydb.USER (USER_id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)$charset_collate";
        
              dbDelta( $sql );       
              

    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."DIPLOMA (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(45) NULL,
        PRIMARY KEY (id))$charset_collate";
        
              dbDelta( $sql );       


    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."SCHOOL (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(45) NULL,
        PRIMARY KEY (id))$charset_collate";
                
              dbDelta( $sql );       

    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."YEAR (
        id INT NOT NULL AUTO_INCREMENT,
        year DATETIME NULL,
        USER_USER_id INT NOT NULL,
        CERTIFICATE_id INT NOT NULL,
        PRIMARY KEY (id, USER_USER_id, CERTIFICATE_id),
        INDEX fk_YEAR_USER2_idx (USER_USER_id ASC) VISIBLE,
        INDEX fk_YEAR_CERTIFICATE1_idx (CERTIFICATE_id ASC) VISIBLE,
        CONSTRAINT fk_YEAR_USER2
          FOREIGN KEY (USER_USER_id)
          REFERENCES mydb.USER (USER_id)
          ON DELETE NO ACTION
          ON UPDATE NO ACTION,
        CONSTRAINT fk_YEAR_CERTIFICATE1
          FOREIGN KEY (CERTIFICATE_id)
          REFERENCES mydb.CERTIFICATE (id)
          ON DELETE NO ACTION
          ON UPDATE NO ACTION)$charset_collate";
                        
              dbDelta( $sql );     
              
              
    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."VISUAL (
        VISUAL_id INT NOT NULL,
        filename VARCHAR(45) NULL,
        PRIMARY KEY (VISUAL_id))$charset_collate";
                        
              dbDelta( $sql );     

    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."LANGUAGE (
        NAME INT NOT NULL AUTO_INCREMENT,
        langue VARCHAR(45) NULL,
        PRIMARY KEY (NAME))$charset_collate";
                                
              dbDelta( $sql );  



    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."HOBBY (
        id INT NOT NULL AUTO_INCREMENT,
        NAME VARCHAR(45) NULL,
        PRIMARY KEY (id))$charset_collate";
                                        
              dbDelta( $sql );  


    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."USER_HOBBIES (
        idUSER_HOBBIES INT NOT NULL AUTO_INCREMENT,
        HOBBY_id INT NOT NULL,
        USER_USER_id INT NOT NULL,
        PRIMARY KEY (idUSER_HOBBIES, HOBBY_id, USER_USER_id),
        INDEX fk_USER_HOBBIES_HOBBY1_idx (HOBBY_id ASC) VISIBLE,
        INDEX fk_USER_HOBBIES_USER1_idx (USER_USER_id ASC) VISIBLE,
        CONSTRAINT fk_USER_HOBBIES_HOBBY1
        FOREIGN KEY (HOBBY_id)
        REFERENCES mydb.HOBBY (id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
        CONSTRAINT fk_USER_HOBBIES_USER1
        FOREIGN KEY (USER_USER_id)
        REFERENCES mydb.USER (USER_id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)$charset_collate";
                                                
              dbDelta( $sql );  



    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."TITLE (
        id INT NOT NULL AUTO_INCREMENT,
        NAME VARCHAR(45) NULL,
        PRIMARY KEY (id))$charset_collate";
                                                
              dbDelta( $sql );  



    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."USER_TITLE (
        id INT NOT NULL AUTO_INCREMENT,
        USER_USER_id INT NOT NULL,
        TITLE_id INT NOT NULL,
        PRIMARY KEY (id, USER_USER_id, TITLE_id),
        INDEX fk_USER_TITLE_USER1_idx (USER_USER_id ASC) VISIBLE,
        INDEX fk_USER_TITLE_TITLE1_idx (TITLE_id ASC) VISIBLE,
        CONSTRAINT fk_USER_TITLE_USER1
          FOREIGN KEY (USER_USER_id)
          REFERENCES mydb.USER (USER_id)
          ON DELETE NO ACTION
          ON UPDATE NO ACTION,
        CONSTRAINT fk_USER_TITLE_TITLE1
          FOREIGN KEY (TITLE_id)
          REFERENCES mydb.TITLE (id)
          ON DELETE NO ACTION
          ON UPDATE NO ACTION)$charset_collate";
                                                        
              dbDelta( $sql );  



    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."COMPANY (
        NAME VARCHAR(45) NULL,
        LOCALISATION VARCHAR(45) NULL,
        URL VARCHAR(45) NULL,
        id INT NOT NULL AUTO_INCREMENT,
        PRIMARY KEY (id))$charset_collate";
                                                        
              dbDelta( $sql );    



    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."DOMAIN (
        id INT NOT NULL AUTO_INCREMENT,
        nom VARCHAR(45) NULL,
        PRIMARY KEY (id))$charset_collate";
                                                          
              dbDelta( $sql );  

    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."EXPERIENCE (
        id INT NOT NULL AUTO_INCREMENT,
        BEGIN DATETIME NULL,
        END DATETIME NULL,
        NAME VARCHAR(45) NULL,
        USER_USER_id INT NOT NULL,
        COMPANY_id INT NOT NULL,
        DOMAIN_id INT NOT NULL,
        PRIMARY KEY (id, USER_USER_id, COMPANY_id, DOMAIN_id),
        INDEX fk_EXPERIENCE_USER1_idx (USER_USER_id ASC) VISIBLE,
        INDEX fk_EXPERIENCE_COMPANY1_idx (COMPANY_id ASC) VISIBLE,
        INDEX fk_EXPERIENCE_DOMAIN1_idx (DOMAIN_id ASC) VISIBLE,
        CONSTRAINT fk_EXPERIENCE_USER1
        FOREIGN KEY (USER_USER_id)
        REFERENCES mydb.USER (USER_id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
        CONSTRAINT fk_EXPERIENCE_COMPANY1
        FOREIGN KEY (COMPANY_id)
        REFERENCES mydb.COMPANY (id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
        CONSTRAINT fk_EXPERIENCE_DOMAIN1
        FOREIGN KEY (DOMAIN_id)
        REFERENCES mydb.DOMAIN (id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)$charset_collate";
                                                                        
              dbDelta( $sql );  



    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."CERTIFICATE (
        NAME VARCHAR(45) NULL,
        id INT NOT NULL AUTO_INCREMENT,
        PRIMARY KEY (id))$charset_collate";
                                                                  
              dbDelta( $sql );    



    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."YEAR (
        id INT NOT NULL AUTO_INCREMENT,
        year DATETIME NULL,
        USER_USER_id INT NOT NULL,
        CERTIFICATE_id INT NOT NULL,
        PRIMARY KEY (id, USER_USER_id, CERTIFICATE_id),
        INDEX fk_YEAR_USER2_idx (USER_USER_id ASC) VISIBLE,
        INDEX fk_YEAR_CERTIFICATE1_idx (CERTIFICATE_id ASC) VISIBLE,
        CONSTRAINT fk_YEAR_USER2
        FOREIGN KEY (USER_USER_id)
        REFERENCES mydb.USER (USER_id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
        CONSTRAINT fk_YEAR_CERTIFICATE1
        FOREIGN KEY (CERTIFICATE_id)
        REFERENCES mydb.CERTIFICATE (id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)$charset_collate";
                                                                            
              dbDelta( $sql );    



    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."realisation_user (
        idrealisation_visual INT NOT NULL AUTO_INCREMENT,
        USER_USER_id INT NOT NULL,
        VISUAL_VISUAL_id INT NOT NULL,
         REALISATIONS_id INT NOT NULL,
        PRIMARY KEY (idrealisation_visual, USER_USER_id, VISUAL_VISUAL_id, REALISATIONS_id),
        INDEX fk_realisation_user_USER1_idx (USER_USER_id ASC) VISIBLE,
        INDEX fk_realisation_user_VISUAL1_idx (VISUAL_VISUAL_id ASC) VISIBLE,
        INDEX fk_realisation_user_REALISATIONS1_idx (REALISATIONS_id ASC) VISIBLE,
        CONSTRAINT fk_realisation_user_USER1
        FOREIGN KEY (USER_USER_id)
        REFERENCES mydb.USER (USER_id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
        CONSTRAINT fk_realisation_user_VISUAL1
        FOREIGN KEY (VISUAL_VISUAL_id)
        REFERENCES mydb.VISUAL (VISUAL_id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
        CONSTRAINT fk_realisation_user_REALISATIONS1
        FOREIGN KEY (REALISATIONS_id)
        REFERENCES mydb.REALISATIONS (id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)$charset_collate";
                                                                            
              dbDelta( $sql );  



    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."level (
        id INT NOT NULL AUTO_INCREMENT,
        level INT NULL,
        LANGUAGE_NAME INT NOT NULL,
        USER_USER_id INT NOT NULL,
        PRIMARY KEY (id, LANGUAGE_NAME, USER_USER_id),
        INDEX fk_level_LANGUAGE1_idx (LANGUAGE_NAME ASC) VISIBLE,
        INDEX fk_level_USER1_idx (USER_USER_id ASC) VISIBLE,
        CONSTRAINT fk_level_LANGUAGE1
        FOREIGN KEY (LANGUAGE_NAME)
        REFERENCES mydb.LANGUAGE (NAME)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
        CONSTRAINT fk_level_USER1
        FOREIGN KEY (USER_USER_id)
        REFERENCES mydb.USER (USER_id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)$charset_collate";
                                                                            
              dbDelta( $sql );  



    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."title_exp (
        id INT NOT NULL AUTO_INCREMENT,
        EXPERIENCE_id INT NOT NULL,
        TITLE_id INT NOT NULL,
        PRIMARY KEY (id, EXPERIENCE_id, TITLE_id),
        INDEX fk_title_exp_EXPERIENCE1_idx (EXPERIENCE_id ASC) VISIBLE,
        INDEX fk_title_exp_TITLE1_idx (TITLE_id ASC) VISIBLE,
        CONSTRAINT fk_title_exp_EXPERIENCE1
        FOREIGN KEY (EXPERIENCE_id)
        REFERENCES mydb.EXPERIENCE (id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
        CONSTRAINT fk_title_exp_TITLE1
        FOREIGN KEY (TITLE_id)
        REFERENCES mydb.TITLE (id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)$charset_collate";
                                                                            
              dbDelta( $sql );    
                  
          
                
                        
              
}

};
register_activation_hook(__FILE__, array('plugbdd', 'pluginActivation'));
add_action( 'plugins_loaded', function(){
    new plugbdd();
} );

