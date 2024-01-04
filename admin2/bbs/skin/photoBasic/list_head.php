
<?
$sql = "
    select
        a.*
    from dm_gallery as a
    where a.show = '1'
    order by a.year desc
";
$result = mysql_query($sql);
//$year_list = $DB->select_assoc_query($sql);

if($gallerylist == "gallery"){
?>
  <div class="tab_link">
    <?
    while($row = mysql_fetch_array($result)){
        $class_on = '';
        if($gallerylist_page  == $row['code'] ){
            $class_on = 'class="on"';
        }

        echo '<a href="/gallery/gallery.html?code='.$row['code'].'" '.$class_on.'>'.$row['year'].'년</a>';
    }
    ?>
  </div>
  <div class="tab_link" style="display: none">
    <a href="/gallery/gallery2023.html" <? if($gallerylist_page  == "gallery2023" ){ ?> class="on" <? } ?>>2023년</a>
    <a href="/gallery/gallery2022.html" <? if($gallerylist_page  == "gallery2022" ){ ?> class="on" <? } ?>>2022년</a>
    <a href="/gallery/gallery2021.html" <? if($gallerylist_page  == "gallery2021" ){ ?> class="on" <? } ?>>2021년</a>
    <a href="/gallery/gallery2020.html" <? if($gallerylist_page  == "gallery2020" ){ ?> class="on" <? } ?>>2020년</a>
    <a href="/gallery/gallery2019.html" <? if($gallerylist_page  == "gallery2019" ){ ?> class="on" <? } ?>>2019년</a>
    <a href="/gallery/gallery2018.html" <? if($gallerylist_page  == "gallery2018" ){ ?> class="on" <? } ?>>2018년</a>
    <a href="/gallery/gallery2017.html" <? if($gallerylist_page  == "gallery2017" ){ ?> class="on" <? } ?>>2017년</a>
    <a href="/gallery/gallery2016.html" <? if($gallerylist_page  == "gallery2016" ){ ?> class="on" <? } ?>>2016년</a>
    <a href="/gallery/gallery2015.html" <? if($gallerylist_page  == "gallery2015" ){ ?> class="on" <? } ?>>2015년</a>
    <a href="/gallery/gallery2014.html" <? if($gallerylist_page  == "gallery2014" ){ ?> class="on" <? } ?>>2014년</a>
  </div>
<? } ?>
      <div class='photo_list'>
  <ul>