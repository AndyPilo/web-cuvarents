
<section class="py-5">
        <div class="container py-2 py-sm-3 py-md-4 py-lg-5 mb-xxl-3">
          <div class="d-flex justify-content-between gap-4 pt-1 pt-sm-2 pt-lg-0 pb-2 pb-md-3 pb-lg-0 mb-4 mb-lg-5">
          <h2>Nuestros clientes</h2>

            <!-- Carousel controls (Prev/next buttons) -->
            <div class="d-flex gap-2">
              <button type="button" class="btn btn-icon btn-lg btn-outline-light bg-transparent text-white border-light animate-slide-start rounded-circle me-1" id="prevTestimonial" aria-label="Previous slide" tabindex="0" aria-controls="swiper-wrapper-227e9e14a176d2f8">
                <i class="fi-chevron-left fs-xl animate-target"></i>
              </button>
              <button type="button" class="btn btn-icon btn-lg btn-outline-light bg-transparent text-white border-light animate-slide-end rounded-circle" id="nextTestimonial" aria-label="Next slide" tabindex="0" aria-controls="swiper-wrapper-227e9e14a176d2f8">
                <i class="fi-chevron-right fs-xl animate-target"></i>
              </button>
            </div>
          </div>

          <!-- Carousel of testimonials (cards) -->
          <div class="swiper swiper-initialized swiper-horizontal swiper-backface-hidden" data-swiper="{
            &quot;slidesPerView&quot;: 1,
            &quot;spaceBetween&quot;: 24,
            &quot;loop&quot;: true,
            &quot;navigation&quot;: {
              &quot;prevEl&quot;: &quot;#prevTestimonial&quot;,
              &quot;nextEl&quot;: &quot;#nextTestimonial&quot;
            },
            &quot;breakpoints&quot;: {
              &quot;680&quot;: {
                &quot;slidesPerView&quot;: 2
              },
              &quot;992&quot;: {
                &quot;slidesPerView&quot;: 3
              }
            }
          }">
            <div class="swiper-wrapper" id="swiper-wrapper-227e9e14a176d2f8" aria-live="polite" style="transition-duration: 0ms; transition-delay: 0ms;">





            
            <?php


// Obtener las recomendaciones de la base de datos
$sql4 = "SELECT * FROM Recommendations ORDER BY created_at DESC";
$result4 = $conn->query($sql4);

$totalRecomendaciones = $result4->num_rows;
$contador = 1;

if ($totalRecomendaciones > 0) {
    while($row4 = $result4->fetch_assoc()) {
        $userName = htmlspecialchars($row4['user_name'], ENT_QUOTES, 'UTF-8');
        $userRank = htmlspecialchars($row4['user_rank'], ENT_QUOTES, 'UTF-8');
        $recommendationText = htmlspecialchars($row4['recommendation_text'], ENT_QUOTES, 'UTF-8');

        echo "
        <!-- Testimonial -->
        <div class=\"swiper-slide h-auto\" role=\"group\" aria-label=\"$contador / $totalRecomendaciones\" style=\"width: 416px; margin-right: 24px;\">
            <div class=\"card shadow h-100  rounded-5 p-sm-2\">
                <div class=\"card-body\">
                    <div class=\"position-relative rtl-flip\" style=\"width: 96px\">
                        <svg class=\"position-absolute top-0 z-1\" style=\"right: 0; margin-right: 30px\" xmlns=\"http://www.w3.org/2000/svg\" width=\"36\" height=\"36\">
                            <circle cx=\"18\" cy=\"18\" r=\"18\" fill=\"#d85151\"></circle>
                            <path d=\"M13.946 10.5l3.797 2.247c-1.403 2.772-2.131 5.365-2.181 7.781V25.5H9.25v-4.635c.017-1.703.48-3.535 1.386-5.492s2.009-3.581 3.31-4.873zm9.006 0l3.797 2.247c-1.402 2.772-2.13 5.365-2.181 7.781V25.5h-6.312v-4.635c.016-1.703.479-3.535 1.385-5.492s2.011-3.581 3.31-4.873z\" fill=\"#fff\"></path>
                        </svg>
                        <div class=\"ratio ratio-1x1 flex-shrink-0 bg-body-secondary rounded-circle overflow-hidden bg-gradient-al\" style=\"width: 48px\"></div>
                    </div>
                    <p class=\"fs-lg text-dark-emphasis pt-4 mb-0\">$recommendationText</p>
                </div>
                <div class=\"card-footer bg-transparent border-0 pt-0 pb-4\">
                    <div class=\"h6 mb-1\">$userName</div>
                    <div class=\"fs-sm text-body-secondary\">$userRank</div>
                </div>
            </div>
        </div>";
        
        $contador++;
    }
    $result4->close(); // Cerrar la consulta
} else {
    echo "<p>No hay recomendaciones disponibles.</p>";
}
?>



             
            </div>
          <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
        </div>
      </section>