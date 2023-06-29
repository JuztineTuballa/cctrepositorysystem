
<script type="text/javascript">
// SEE MORE ONLY
 $(document).ready(function() {
  $('.truncate').each(function() {
    var $this = $(this);
    var $seeMore = $('<a href="show_all.php" class="see-more"> See more</a>');
    var fullText = $this.text();
    $seeMore.on('click', function(event) {
      event.preventDefault();
      $this.text(fullText);
    });
    $this.text(fullText.substr(0, 150) + '...'); /* or any other value */
    $this.append($seeMore);
  });
});
// END SEE MORE ONLY

//  SEE MORE AND SEE LESS
//  $(document).ready(function() {
//   $('.truncate').each(function() {
//     var $this = $(this);
//     var $seeMore = $('<a href="show_all.php" class="see-more"> See more</a>');
//     var $seeLess = $('<a href="show_all.php" class="see-less"> See less</a>');
//     var fullText = $this.text();
//     $seeMore.on('click', function(event) {
//       event.preventDefault();
//       $this.text(fullText);
//       $this.append($seeLess);
//     });
//     $seeLess.on('click', function(event) {
//       event.preventDefault();
//       $this.text(fullText.substr(0, 150) + '...'); /* or any other value */
//       $this.append($seeMore);
//       $seeLess.remove();
//     });
//     $this.text(fullText.substr(0, 150) + '...'); /* or any other value */
//     $this.append($seeMore);
//   });
// });
// END SEE MORE AND SEE LESS



</script>

