<section class="widget widget-categories">
  <h3 class="widget-title">Filtrar por precio</h3>
  <form class="price-range-slider" method="post" data-start-min="250" data-start-max="650" data-min="0" data-max="1000" data-step="1">
    <div class="ui-range-slider"></div>
    <footer class="ui-range-slider-footer">
      <div class="column">
        <button class="btn btn-outline-primary btn-sm" type="submit">Establecer</button>
      </div>
      <div class="column">
        <div class="ui-range-values">
          <div class="ui-range-value-min">$<span></span>
            <input type="hidden" name="min_precie">
          </div>&nbsp;-&nbsp;
          <div class="ui-range-value-max">$<span></span>
            <input type="hidden" value="max_precie">
          </div>
        </div>

      </div>
    </footer>
  </form>
</section>
