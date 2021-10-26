<?php 
$user = current_user();
$notificaciones = notificaciones();

$obras = obras_inspeccion($user['id'],$user['idusuarios']);







?>
<style>
    .popular_courses {
    padding-bottom: 100px;
}
@media (max-width: 991px) {
    .popular_courses {
        padding-bottom: 40px;
    }
}
.popular_courses .owl-item {
    opacity: 0;
    -webkit-transition: all 0.3s ease 0s;
    -moz-transition: all 0.3s ease 0s;
    -o-transition: all 0.3s ease 0s;
    transition: all 0.3s ease 0s;
    padding: 0px 10px;
    padding-bottom: 30px;
}
.popular_courses .owl-item.active {
    opacity: 1;
}
.popular_courses .owl-nav {
    display: flex !important;
    justify-content: space-between;
    position: absolute;
    top: 50%;
    width: 120%;
    transform: translateY(-50%);
    left: -11%;
}
@media (max-width: 991px) {
    .popular_courses .owl-nav {
        display: none !important;
    }
}
.popular_courses .owl-nav .owl-prev img,
.popular_courses .owl-nav .owl-next img {
    -webkit-filter: grayscale(100%);
    -moz-filter: grayscale(100%);
    -ms-filter: grayscale(100%);
    -o-filter: grayscale(100%);
    filter: grayscale(100%);
    -webkit-transition: all 0.3s ease 0s;
    -moz-transition: all 0.3s ease 0s;
    -o-transition: all 0.3s ease 0s;
    transition: all 0.3s ease 0s;
}
.popular_courses .owl-nav .owl-prev img:hover,
.popular_courses .owl-nav .owl-next img:hover {
    -webkit-filter: grayscale(0%);
    -moz-filter: grayscale(0%);
    -ms-filter: grayscale(0%);
    -o-filter: grayscale(0%);
    filter: grayscale(0%);
}

.single_course {
    -webkit-transition: all 0.3s ease 0s;
    -moz-transition: all 0.3s ease 0s;
    -o-transition: all 0.3s ease 0s;
    transition: all 0.3s ease 0s;
}
.single_course .course_head {
    position: relative;
    overflow: hidden;
}
.single_course .course_head img {
    -webkit-transition: all 0.3s ease 0s;
    -moz-transition: all 0.3s ease 0s;
    -o-transition: all 0.3s ease 0s;
    transition: all 0.3s ease 0s;
}
.single_course .price {
    position: absolute;
    top: -34px;
    right: 15px;
    z-index: 2;
    color: #002347;
    display: inline-block;
    height: 65px;
    line-height: 65px;
    width: 65px;
    text-align: center;
    border-radius: 50px;
    background: #fdc632;
    font-family: "Rubik", sans-serif;
    font-weight: 500;
    font-size: 20px;
    -webkit-transition: all 0.3s ease 0s;
    -moz-transition: all 0.3s ease 0s;
    -o-transition: all 0.3s ease 0s;
    transition: all 0.3s ease 0s;
}
.single_course .price img {
    margin-top: -8px;
    -webkit-transition: all 0.3s ease 0s;
    -moz-transition: all 0.3s ease 0s;
    -o-transition: all 0.3s ease 0s;
    transition: all 0.3s ease 0s;
}
.single_course .course_content {
    padding: 30px 26px;
    background: #f9f9ff;
    position: relative;
    -webkit-transition: all 0.3s ease 0s;
    -moz-transition: all 0.3s ease 0s;
    -o-transition: all 0.3s ease 0s;
    transition: all 0.3s ease 0s;
}
.single_course .course_content .tag {
    padding: 2px 21px;
    font-size: 13px;
    color: #fff;
    background: #002347;
    text-transform: uppercase;
}
.single_course .course_content h4 {
    font-size: 20px;
    font-weight: 500;
}
.single_course .course_content h4 a {
    color: #002347;
}
.single_course .course_content p {
    margin: 0;
}
.single_course .course_content .course_meta {
    margin-top: 25px;
}
.single_course .course_content .course_meta .meta_info a {
    color: #002347;
}
.single_course .authr_meta img {
    width: 45px !important;
    height:auto;
    display: inline-block !important;
}
.single_course .authr_meta span {
    color: #002347;
    font-weight: 500;
}
.single_course:hover {
    box-shadow: 0px 10px 30px rgba(0, 35, 71, 0.1);
}
.single_course:hover .course_head img {
    -webkit-transform: scale(1.2);
    -moz-transform: scale(1.2);
    -ms-transform: scale(1.2);
    -o-transform: scale(1.2);
    transform: scale(1.2);
}
.single_course:hover .course_content {
    background: #fff;
}
.single_course:hover .price {
    background: #002347;
    color: #fdc632;
}
.single_course:hover h4 a {
    color: #fdc632;
}
.event-list .event-item {
    padding: 1rem 1.9rem;
    margin: 0 0.9375rem 1.875rem 0.9375rem;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
    -webkit-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
    -moz-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
    -ms-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
}

.event-list .event-item.featured {
    border: 1.5px solid #68cbd7;
}

.event-list .event-item .event-schedule {
    color: #3c4142;
    margin-bottom: 0.625rem;
}

.event-list .event-item .event-schedule .event-icon {
    stroke-width: 1px;
    width: 1.125rem;
    height: 1.125rem;
    margin: 0.6875rem 1rem 0 0;
}

.event-list .event-item .event-schedule .event-day {
    font-size: 70px;
    font-weight: 200;
    margin-right: 1rem;
    line-height: 100%;
}

.event-list .event-item .event-schedule .event-month-time {
    font-weight: 200;
    font-size: 22px;
    display: flex;
    line-height: 118%;
    flex-direction: column;
    justify-content: center;
}

.event-list .event-item .event-schedule .event-month-time span {
    display: block;
    text-transform: uppercase;
}

.event-list .event-item .event-title {
    display: block;
    margin-bottom: 0.625rem;
    font-weight: 300;
    color: #3c4142;
}

.event-list .event-item .event-title:hover {
    color: #68cbd7;
    text-decoration: none;
}

.event-list .event-item .event-content {
    color: #b1bac5;
    margin-bottom: 0.625rem;
    font-size: 12px;
    font-weight: 300;
}

.event-list .event-item .event-participants {
    padding: 0;
    margin: 0;
}

.event-list .event-item .event-participants .event-user {
    width: 48px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    border: 2px solid #ffffff;
}

.event-list .event-item .event-participants .event-user .event-user-inital {
    font-size: 13px;
    line-height: 100%;
}

.event-list .event-item .event-participants {
    display: flex !important;
}

.event-list .event-item .event-participants .event-user .event-user-pic {
    width: 100%;
    border-radius: 50%;
}

.event-list .event-item .event-participants li + li {
    margin-left: -10px;
}


.event-list .event-item .event-participants {
    flex-direction: row !important;
}
.event-list .event-item .event-participants {
    padding: 0;
    margin: 0;
}

.bg-soft-primary {
    background-color: #dce3fa;
}

.bg-soft-danger {
    background-color: #fedce0;
}

.bg-soft-info {
    background-color: #d7efff;
}

.bg-soft-success {
    background-color: #d1f6f2;
}

.event-list .event-item .event-schedule, .event-list .event-item .event-participants{
    display: flex !important;
}


.owl-prev {
  width: 100px;
  height: 100%;
  position: absolute;
  top: 0;
  margin-left: 0;
  display: block !important;
}

.owl-prev .owl-nav-wrapper {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.owl-prev .owl-nav-wrapper svg, .owl-prev .owl-nav-wrapper i {
  color: #ffffff;
  width: 20px;
  height: 20px;
}

.owl-next {
  width: 100px;
  height: 100%;
  position: absolute;
  top: 0;
  right: 0;
  display: block !important;
}

.owl-next .owl-nav-wrapper {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-left: auto;
}

.owl-next .owl-nav-wrapper svg, .owl-next .owl-nav-wrapper i {
  color: #ffffff;
  width: 20px;
  height: 20px;
}

.owl-dots {
  text-align: center;
  margin-top: .5rem;
}

.owl-dots .owl-dot {
  width: 10px;
  height: 10px;
  border-radius: 100%;
  background: #cbcbcb !important;
  margin-right: 5px;
  display: inline-block;
}

.owl-dots .owl-dot.active {
  background: #757575 !important;
}

.text-primary, .task-list-wrapper .completed .remove {
    color: #4e73e5 !important;
}
</style>
<br><br>
  <div class="row ">
    <p class="titulo-bienvenida p-b-20">Obras designadas
    </p>
  </div>

<div class="popular_courses">
                <div class="owl-carousel active_course owl-loaded owl-drag">
                    <div class="owl-stage-outer">
                        <div class="owl-stage" style="transform: translate3d(-1520px, 0px, 0px); transition: all 1.5s ease 0s; width: 3420px;">
                        <?php foreach ($obras as $obra): 
                            
$equipo_inspector = equipo_inspector($user['id'],$obra['idobras']);
if($equipo_inspector['idobras'] == $obra['idobras']){
                            ?>
                            <div class="owl-item" style="width: 350px; margin-right: 30px;">
                                <div class="single_course">
                                    <div class="course_content">
                                        <span class="tag mb-4 d-inline-block"><?php 
                  if($obra['estado'] == 0){ echo 'En ejecucion'; }
                  if($obra['estado'] == 3 && $obra['recepcion'] == 0){ echo 'Finalizada sin recibir'; }
                  if($obra['estado'] == 3 && $obra['recepcion'] == 1){ echo 'En garantia'; }
                  if($obra['estado'] == 3 && $obra['recepcion'] == 2){ echo 'Finalizada definitiva'; }
                  if($obra['estado'] == 4){ echo 'Neutralizada'; }
                  if($obra['estado'] == 5){ echo 'Rescindida'; } ?></span>
                                        <h5 class="mb-3">
                                            <a href="obra?id=<?php echo $obra['idobras'] ?>"><?php echo $obra['nombre']; ?></a>
                                        </h5>
                                        <p></p>
                                        <div class="course_meta d-flex justify-content-lg-between align-items-lg-center flex-lg-row flex-column mt-4">
                                            
                                            <div class="mt-lg-0 mt-3">
                                                <span class="meta_info mr-3">
                                                    <span class=""> <i class="ti-file mr-2"></i><?php echo $obra['expediente']; ?></span>
                                                </span>
                                                <span class="meta_info">
                                                <span class=""> <i class="ti-stats-up mr-2"></i><?php echo $obra['certificado_porcentaje']; ?> % </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }elseif($user['id'] == $obra['idinspector']){
                                ?>
                                
                            <div class="owl-item" style="width: 350px; margin-right: 30px;">
                                <div class="single_course">
                                    <div class="course_content">
                                        <span class="tag mb-4 d-inline-block"><?php 
                  if($obra['estado'] == 0){ echo 'En ejecucion'; }
                  if($obra['estado'] == 3 && $obra['recepcion'] == 0){ echo 'Finalizada sin recibir'; }
                  if($obra['estado'] == 3 && $obra['recepcion'] == 1){ echo 'En garantia'; }
                  if($obra['estado'] == 3 && $obra['recepcion'] == 2){ echo 'Finalizada definitiva'; }
                  if($obra['estado'] == 4){ echo 'Neutralizada'; }
                  if($obra['estado'] == 5){ echo 'Rescindida'; } ?></span>
                                        <h5 class="mb-3">
                                            <a href="obra?id=<?php echo $obra['idobras'] ?>"><?php echo $obra['nombre']; ?></a>
                                        </h5>
                                        <p></p>
                                        <div class="course_meta d-flex justify-content-lg-between align-items-lg-center flex-lg-row flex-column mt-4">
                                            
                                            <div class="mt-lg-0 mt-3">
                                                <span class="meta_info mr-3">
                                                    <span class=""> <i class="ti-file mr-2"></i><?php echo $obra['expediente']; ?></span>
                                                </span>
                                                <span class="meta_info">
                                                <span class=""> <i class="ti-stats-up mr-2"></i><?php echo $obra['certificado_porcentaje']; ?> % </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <?php
                            } endforeach; ?>
                            
                        </div>
                    </div>
                </div>
        </div>




<script>
     function active_course() {
    if ($(".active_course").length) {
      $(".active_course").owlCarousel({
        loop: true,
        margin: 10,
        items: 2,
        nav: true,
        autoplay: 2500,
        smartSpeed: 1500,
        dots: false,
        responsiveClass: true,
        thumbs: true,
        thumbsPrerendered: true,
        navText: ["<i class='ti-angle-left nav-color'>", "<i class='ti-angle-right nav-color'>"],
        responsive: {
          0: {
            items: 1,
            margin: 0
          },
          991: {
            items: 2,
            margin: 10
          },
          1200: {
            items: 2,
            margin: 10
          }
        }
      });
    }
  }
  active_course(); 
  (function($) {
    'use strict';
    $(function () {
        //Event carousel
        $("#events").owlCarousel({
            loop:true,
            margin:0,
            autoPlay: 3000,
            responsive:{
                0:{
                    items:1
                },
                768:{
                    items:2
                },
                979:{
                    items:3
                },
                1199:{
                    items:4
                }
            },
            singleItem : false,
            dots: false,
            nav: true,
            navText : ["",""]
        });
        $(".btn-event-show").collapse();
        //Events: Tooltip
        $('.event-user').tooltip({ boundary: 'window' });
        feather.replace();
    });
})(jQuery); 
</script>


