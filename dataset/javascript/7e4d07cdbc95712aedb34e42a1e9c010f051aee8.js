function clearScripts(node){
      var rslt = {};
      for(var key in node){
        var val = node[key];
        if(_.isString(val)){
          if(val.trim()) rslt[key] = "...";
        }
        else{
          var childScripts = clearScripts(val);
          if(!_.isEmpty(childScripts)) rslt[key] = childScripts;
        }
      }
      return rslt;
    }