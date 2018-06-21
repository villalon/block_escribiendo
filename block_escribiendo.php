<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Listado de actividades
 *
 * @package   block_escribiendo
 * @copyright 1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class block_escribiendo extends block_base {

    function init() {
        $this->title = get_string('pluginname', 'block_escribiendo');
    }

    function instance_allow_multiple() {
        return false;
    }

    function get_content() {
        global $CFG, $DB;

        if ($this->content !== NULL) {
            return $this->content;
        }
        
        $query = "SELECT a.id, g.name genrename, a.description, a.title
		FROM {emarking_activities} a LEFT JOIN {emarking_activities_genres} g ON (g.id = a.genre)
		WHERE status = 1 AND parent IS NULL
		ORDER BY RAND()
			LIMIT 4";
        
        $activities = $DB->get_records_sql($query);
        $activityArray=array();
        foreach ($activities as $activity){
            $url = new moodle_url($CFG->wwwroot.'/mod/emarking/activities/activity.php', array('id'=>$activity->id));
            // $genre=$DB->get_record('emarking_activities_genres',array('id'=>$activity->genre));
            $activityArray[]=array(
                'title'=>$activity->title,
                'genre'=>$activity->genrename,
                'description'=>$activity->description,
                'link'=>$url
            );
        }

        $this->content = new stdClass;
        $this->content->footer = '';
        $this->content->text = '
	<!-- Slider -->
	<div id="myCarousel" class="carousel slide">

		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
		</ol>

		<div class="carousel-inner">

			<div class="item active">
				<img src="'.$CFG->wwwroot.'/mod/emarking/activities/img/slide1.png" alt="01" class="img-responsive"
					style="min-width: 100%;">
				<div class="carousel-caption"></div>
			</div>

			<div class="item">
				<img src="'.$CFG->wwwroot.'/mod/emarking/activities/img/slide02.png" alt="02" class="img-responsive"
					style="min-width: 100%;">
				<div class="carousel-caption"></div>
			</div>

		</div>

		<a class="carousel-control left" href="#myCarousel" data-slide="prev">
			<span class="icon-prev"></span>
		</a> <a class="carousel-control right" href="#myCarousel"
			data-slide="next"> <span class="icon-next"></span>
		</a>

	</div>
	<!-- Slider End -->



	<!-- Actividades -->
	<div class="row_activities" >
		<div class="container">
			<br>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tit_actv"></div>
			</div>

			<div class="row">
				
				<div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 col_height"
					style="background-color: #085B7F;">
					
					<h4 class="subtit_actv">Género: '.$activityArray[0]['genre'].'</h4>
					<h2 class="h2tit_actv">
						<a class="h2tit_actv" href="'.$activityArray[0]['link'].'"> '.$activityArray[0]['title'].'</a>
					</h2>
					<hr>
					<br>
					<p class="text-justify text_actv">'.$activityArray[0]['description'].'</p>
				
				</div>
				
				<div class="col-xs-12 col-sm-2 col-md-4 col-lg-6 img1_actv"></div>
				<div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 col_height"
					style="background-color: #097C5E;">
					<h4 class="subtit_actv">Género: '.$activityArray[1]['genre'].'</h4>
					<h2 class="h2tit_actv">
						<a class="h2tit_actv" href="'.$activityArray[1]['link'].'"> '.$activityArray[1]['title'].'</a>
					</h2>
					<hr>
					<br>
					<p class="text-justify text_actv">'.$activityArray[1]['description'].'</p>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-1 col-sm-1 col-md-2 col-lg-3 img2_actv"></div>
				<div class="col-xs-11 col-sm-4 col-md-4 col-lg-4 col_height"
					style="background-color: #7C3709;">
										<h4 class="subtit_actv">Género: '.$activityArray[2]['genre'].'</h4>
					<h2 class="h2tit_actv">
						<a class="h2tit_actv" href="'.$activityArray[2]['link'].'"> '.$activityArray[2]['title'].'</a>
					</h2>
					<hr>
					<br>
					<p class="text-justify text_actv">'.$activityArray[2]['description'].'</p>

				</div>
				<div class="col-xs-11 col-sm-4 col-md-4 col-lg-4 col_height"
					style="background-color: #757A0A;">
										<h4 class="subtit_actv">Género: '.$activityArray[3]['genre'].'</h4>
					<h2 class="h2tit_actv">
						<a class="h2tit_actv" href="'.$activityArray[3]['link'].'"> '.$activityArray[3]['title'].'</a>
					</h2>
					<hr>
					<br>
					<p class="text-justify text_actv">'.$activityArray[3]['description'].'</p>

				</div>
				<div class="col-xs-1 col-sm-3 col-md-2 col-lg-3 img2_actv"></div>
			</div>

			<br>
			<br>

		</div>
	</div>
	<!-- Actividades END -->

	<!-- Caracteristicas -->
	<div class="row_caract">
		<div class="container">
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" align="center">
				<img src="'.$CFG->wwwroot.'/mod/emarking/activities/img/caract_01_01.png">
				<h4>Crea tu Perfil</h4>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" align="center">
				<img src="'.$CFG->wwwroot.'/mod/emarking/activities/img/caract_01_03.png">
				<h4>Crea Actividades</h4>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" align="center">
				<img src="'.$CFG->wwwroot.'/mod/emarking/activities/img/caract_01_05.png">
				<h4>Participa en el Foro</h4>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" align="center">
				<img src="'.$CFG->wwwroot.'/mod/emarking/activities/img/caract_01_08.png">
				<h4>Conviértete en Corrector</h4>
			</div>
		</div>
	</div>
	<!-- Caracteristicas End -->

	<!-- Quienes Somos -->
	<div class="row_info">
		<div class="container">


			<div class="col-xs-12 col-sm-3 col-md-6 col-lg-6 tit_blue">
				<h2>Quiénes Somos</h2>
				<br>
				<p class="text_grey1" align="justify">Escribiendo.online es una comunidad de
					aprendizaje comprometida con la enseñanza de la escritura en las
					aulas chilenas. Sabemos que aprender a escribir es un proceso
					complejo en el que los estudiantes necesitan ser guiados por sus
					profesores. Pero también sabemos lo difícil y lento que puede
					resultar revisar y retroalimentar la escritura de los estudiantes.
				</p>
				<p class="text_grey1" align="justify">Por esto hemos creado esta plataforma
					colaborativa en línea que permite a los profesores compartir
					actividades, videos y pautas de evaluación de la escritura, así
					como corregir y retroalimentar en línea los textos de sus
					estudiantes o recibir una evaluación experta de los textos de sus
					alumnos.
				</p>
			</div>

			<div class="col-xs-12 col-sm-9 col-md-6 col-lg-6 tit_blue"
				align="center">
<iframe width="560" height="315" src="https://www.youtube.com/embed/CAKj1hkuJIo" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>			</div>
		</div>

	</div>

';

        return $this->content;
    }
}
