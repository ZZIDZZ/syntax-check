function getNearest($select, value) {
                var delta = {};
                $select.children('option').each(function(i, opt){
                    var optValue = $(opt).attr('value'),
                    distance;

                    if(optValue === '') return;
                    distance = Math.abs(optValue - value); 
                    if(typeof delta.distance === 'undefined' || distance < delta.distance) {
                        delta = {value: optValue, distance: distance};
                    } 
                }); 
                return delta.value;
            }