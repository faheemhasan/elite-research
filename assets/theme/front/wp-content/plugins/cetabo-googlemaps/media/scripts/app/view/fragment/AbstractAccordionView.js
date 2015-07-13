/*
Generic accordion implementation
*/


(function() {
  Cetabo.AbstractAccordionView = Cetabo.BaseView.extend({
    events: {
      "click .add": "addNew",
      "click .remove": "remove"
    },
    /*
    Get accordion DOM element
    */

    getAccordion: function() {
      return jQuery(this.getAccordionIdentifier());
    },
    /*
    Get accordion DOM element identifier
    */

    getAccordionIdentifier: function() {
      return "#" + this.getElId() + " .accordion";
    },
    /*
    Perform required initializations
    */

    initAccordionControl: function() {
      this.getAccordion().accordion();
      this.bindListeners();
    },
    bindListeners: function() {
      var instance;
      instance = this;
      this.getAccordion().on("accordionactivate", function(event, ui) {
        var index;
        index = instance.getActiveIndex();
        instance.onExpand(index);
      });
      this.getAccordion().on("accordionbeforeactivate", function(event, ui) {
        var index;
        index = instance.getActiveIndex();
        instance.onPreexpand(index);
      });
    },
    getActiveIndex: function() {
      return this.getAccordion().accordion("option", "active");
    },
    onExpand: function(index) {},
    onPreexpand: function(index) {},
    /*
    Get accordion index by element identifier
    */

    resolveAccordionIndexById: function(id) {
      var index;
      index = 0;
      this.getAccordion().children(".accordion-content").each(function(i) {
        if (id === this.id) {
          index = i;
        }
      });
      return index;
    },
    resolveAccordionIdByIndex: function(index) {
      var id;
      id = undefined;
      this.getAccordion().children(".accordion-content").each(function(i) {
        if (index === i) {
          id = this.id;
        }
      });
      return id;
    },
    getDataModelAtIndex: function(index) {
      return this.modelReference[index];
    },
    buildAccordionElementIdentifier: function() {
      return "ident" + Math.floor(Math.random() * 100000);
    },
    /*
    Add new accordion element
    */

    addNew: function() {
      var accordionElement, newElementId;
      newElementId = this.buildAccordionElementIdentifier();
      accordionElement = this.createAccordionElement(newElementId);
      this.getAccordion().append(accordionElement);
      this.createAccordionElementDataModel(newElementId);
      this.afterElementCreation(newElementId);
      this.refresh();
      this.afterElementAdded(newElementId);
      return newElementId;
    },
    bindModel: function(id, model) {
      var accordionElement, newElementId;
      newElementId = id;
      accordionElement = this.createAccordionElement(newElementId);
      this.getAccordion().append(accordionElement);
      this.afterElementCreation(newElementId);
      this.refresh();
      this.afterElementAdded(newElementId);
    },
    refresh: function() {
      this.getAccordion().accordion("refresh");
    },
    /*
    Build element, abstract method to be implemented in children classes
    */

    createAccordionElement: function(newElementId) {},
    /*
    Build element model, abstract method to be implemented in children classes
    */

    createAccordionElementDataModel: function(newElementId) {},
    /*
    Anny additional work to be done after elemnt creation
    */

    afterElementCreation: function(newElementId) {},
    afterElementAdded: function(newElementId) {},
    /*
    Remove selected accordion element
    */

    remove: function(event) {
      var removingElementId, selectedAccordionElement;
      selectedAccordionElement = event.currentTarget;
      removingElementId = jQuery(selectedAccordionElement).attr("identif");
      jQuery(event.currentTarget).parent("h3").next("div").andSelf().remove();
      this.getAccordion().accordion("refresh");
      this.afterElementRemoval(removingElementId);
      if (this.getElementsCount() === 0) {
        this.onClear();
      }
    },
    removeAll: function() {
      this.getAccordion().html("");
      this.getAccordion().accordion("refresh");
    },
    getElementsCount: function() {
      var children;
      children = this.getAccordion().children(".accordion-content");
      if (children !== undefined) {
        return children.length;
      } else {
        return 0;
      }
    },
    onClear: function() {},
    /*
    Anny additional work to be done after elemnt removal
    */

    afterElementRemoval: function(elementId) {},
    /*
    Select accordion element
    */

    expand: function(elementId) {
      var index;
      index = this.resolveAccordionIndexById(elementId);
      this.getAccordion().accordion("option", "active", index);
    }
  });

}).call(this);
