(function() {
  Cetabo.ArrayUtil = {
    has: function(array, v) {
      var i;
      i = 0;
      while (i < array.length) {
        if (array[i] === v) {
          return true;
        }
        i++;
      }
      return false;
    },
    removeByPosition: function(array, from, to) {
      var rest;
      if (from === undefined || to === undefined) {
        return array;
      }
      rest = array.slice((to || from) + 1 || array.length);
      array.length = (from < 0 ? array.length + from : from);
      return array.push.apply(array, rest);
    },
    removeByContent: function(array, content) {
      var i;
      i = 0;
      while (i < array.length) {
        if (array[i] === content) {
          Cetabo.ArrayUtil.removeByPosition(array, i, i);
        }
        i++;
      }
    },
    asSet: function(array) {
      var i, l, result;
      result = [];
      i = 0;
      l = array.length;
      while (i < l) {
        if (result.indexOf(array[i]) === -1) {
          result.push(array[i]);
        }
        i++;
      }
      return result;
    },
    pushArray: function(array, toPush) {
      var i, len;
      i = 0;
      len = toPush.length;
      while (i < len) {
        array.push(toPush[i]);
        ++i;
      }
    }
  };

  Cetabo.StringUtil = {
    replaceAll: function(str, find, replace) {
      return str.replace(new RegExp(find, "g"), replace);
    },
    trim: function(str, chars) {
      return str.rtrim(chars).ltrim(chars);
    },
    ltrim: function(str, chars) {
      chars = chars || "\\s";
      return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
    },
    rtrim: function(str, chars) {
      chars = chars || "\\s";
      return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
    },
    isEmpty: function(str) {
      return str === undefined || str === null || str.trim() === "";
    }
  };

}).call(this);
