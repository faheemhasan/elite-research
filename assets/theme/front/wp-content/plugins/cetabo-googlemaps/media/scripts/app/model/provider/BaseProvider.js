(function() {
  Cetabo.BaseProvider = Backbone.Model.extend({
    invoke: function(callback) {
      callback();
    },
    /*
    Provide source data model
    */

    getDataModel: function() {
      var data, dataSet, i, result;
      result = [];
      dataSet = this.getData();
      i = 0;
      while (i < dataSet.length) {
        data = dataSet[i];
        result.push(data);
        i++;
      }
      return result;
    },
    /*
    Find custom value by a specified comaprator function
    */

    valueOf: function(comparator) {
      var dataSet, key;
      dataSet = this.getData();
      for (key in dataSet) {
        if (comparator(dataSet[key])) {
          return dataSet[key];
        }
      }
      return undefined;
    },
    getData: function() {
      return this.get("data");
    },
    setData: function(rawData) {
      this.set("data", rawData);
    },
    getDefault: function() {
      return 0;
    }
  });

}).call(this);
