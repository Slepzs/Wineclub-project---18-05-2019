<?php


?>


  <fieldset class="uk-fieldset">

      <legend class="uk-legend">Today's Wine</legend>
      <hr>

<div class="uk-grid-small" uk-grid>

   <div class="uk-width-1-2@s">
       <input class="uk-input" type="text" name="wine[wine_name]" placeholder="Wine Name" value="<?= $wine->wine_name ?? ''; ?>">
   </div>

   <div class="uk-width-1-2@s">
       <input class="uk-input" type="text" name="wine[wine_region_country]" placeholder="Wine Country and Region" value="<?= $wine->wine_region_country ?? ''; ?>">
   </div>
   <div class="uk-width-1-2@s">
    <input class="uk-input" type="text" name="wine[wine_grapes]" placeholder="Wine Grape(s)" value="<?= $wine->wine_grapes ?? ''; ?>">
  </div>
  <div class="uk-width-1-2@s">
    <input class="uk-input" type="text" name="wine[wine_year]" placeholder="Wine Year" value="<?= $wine->wine_year ?? ''; ?>">
  </div>

  <div class="uk-width-1-2@s">
    <input class="uk-input" type="text" name="wine[wine_volume]" placeholder="Volume %" value="<?= $wine->wine_volume ?? ''; ?>">
</div>

  <div class="uk-width-1-2@s">

       <div class="selectdropdown" uk-form-custom="target: > * > span:first-child">
           <select name="wine[wine_size]" value="">
               <option value="<?= $wine->wine_size ?>"><?php echo $wine->wine_size ?? 'Size'; ?></option>
               <option value="0.75">0.75L</option>
               <option value="1">1L</option>
               <option value="1.5">1.5L</option>
               <option value="3.5">3L</option>
               <option value="4">4L</option>
           </select>
           <button class="uk-button uk-button-default" type="button" tabindex="-1">
               <span></span>
               <span uk-icon="icon: chevron-down"></span>
           </button>
       </div>

   </div>

   <div class="uk-width-1-2@s">
     <input class="uk-input" type="text" name="wine[wine_price]" placeholder="Price" value="<?= $wine->wine_price ?? ''; ?>">
 </div>

 <div class="uk-width-1-2@s">
   <input class="uk-input" type="text" name="wine[wine_real_price]" placeholder="Real Price" value="<?= $wine->wine_real_price ?? ''; ?>">
</div>

 <div class="uk-width-1-2@s">
   <input class="date" type="date" name="wine[wine_date]" placeholder="Date" value="<?= $wine->wine_date ?? ''; ?>">
</div>


 <div class="uk-width-1-1@s">

    <div class="uk-margin" uk-margin>
        <div uk-form-custom="target: true">
            <input type="file" name="wine_img">
            <input class="uk-input selectform" type="text" placeholder="Select file" disabled>
        </div>
    </div>

    </div>


<div class="uk-width-1-1@s">
  <input class="uk-input" type="text" name="wine[wine_boughtby]" placeholder="Bought By" value="<?= $wine->wine_boughtby ?? ''; ?>">
</div>

<div class="uk-width-1-1@s">
  <button type="submit" name="submit" class="uk-button uk-button-primary winesubmit">Submit Wine</button>
</div>

  </fieldset>




