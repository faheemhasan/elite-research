(function() {
  Cetabo.PlacesTabView = Cetabo.BaseView.extend({
    events: {
      "click .place-ident": "focusPlace"
    },
    initialize: function(config) {
      this.config = config;
      this.model = config.model;
      this.channel = config.channel;
      Cetabo.EventDistpatcher.use(this.channel).on("map.load", this.onLoadMapCallback, this);
      Cetabo.EventDistpatcher.use(this.channel).on("place.filter", this.onPlaceFilter, this);
      Cetabo.EventDistpatcher.use(this.channel).on("place.remove", this.onRemovePlace, this);
      Cetabo.EventDistpatcher.use(this.channel).on("place.update", this.onUpdatePlace, this);
    },
    onRemovePlace: function(place) {
      var places;
      places = this.model.getMapPlaces();
      places.pop(place);
      this.refreshPlaces(places);
    },
    onUpdatePlace: function(place) {
      var places, visiblePlaces, _i, _len, _place;
      places = this.model.getMapPlaces();
      if (this.isStepPlace(place)) {
        places.push(place);
      }
      visiblePlaces = [];
      for (_i = 0, _len = places.length; _i < _len; _i++) {
        _place = places[_i];
        if (this.isPlaceNameNotEmpty(_place)) {
          visiblePlaces.push(_place);
        }
      }
      this.refreshPlaces(visiblePlaces);
    },
    isPlaceNameNotEmpty: function(place) {
      if (place.get("name") !== undefined && place.get("name").trim().length > 0) {
        return true;
      }
    },
    isStepPlace: function(place) {
      return place.get("transient") === true;
    },
    onLoadMapCallback: function(model) {
      this.refreshPlaces(model.getMapPlaces());
    },
    onPlaceFilter: function(criteria) {
      var places, visiblePlaces, _i, _len, _place;
      places = this.model.getMapPlaces();
      visiblePlaces = [];
      for (_i = 0, _len = places.length; _i < _len; _i++) {
        _place = places[_i];
        if (_place.isPassingCriteriaCheck(criteria) && this.isPlaceNameNotEmpty(_place)) {
          visiblePlaces.push(_place);
        }
      }
      this.refreshPlaces(visiblePlaces);
    },
    refreshPlaces: function(places) {
      var html, template;
      template = Cetabo.TemplateManager.getTemplateByName("#template-places");
      html = template({
        'places': places
      });
      this.find('').html(html);
      this.delegateEvents();
    },
    focusPlace: function(event) {
      var place, placeId, target;
      target = event.currentTarget;
      placeId = this.resolvePlace(target);
      place = this.model.getPlaceById(placeId);
      Cetabo.EventDistpatcher.use(this.channel).trigger("place.focus", place);
      return false;
    },
    resolvePlace: function(target) {
      return jQuery(target).data('place');
    }
  });

}).call(this);
