function(self, other){
    if(_b_.isinstance(other, int)){
        other = int_value(other)
        if(typeof other == "number"){
            var res = self.valueOf() - other.valueOf()
            if(res > $B.min_int && res < $B.max_int){return res}
            else{return $B.long_int.__sub__($B.long_int.$factory(self),
                $B.long_int.$factory(other))}
        }else if(typeof other == "boolean"){
            return other ? self - 1 : self
        }else{
            return $B.long_int.__sub__($B.long_int.$factory(self),
                $B.long_int.$factory(other))
        }
    }
    if(_b_.isinstance(other, _b_.float)){
        return new Number(self - other)
    }
    if(_b_.isinstance(other, _b_.complex)){
        return $B.make_complex(self - other.$real, -other.$imag)
    }
    if(_b_.isinstance(other, _b_.bool)){
         var bool_value = 0;
         if(other.valueOf()){bool_value = 1}
         return self - bool_value
    }
    if(_b_.isinstance(other, _b_.complex)){
        return $B.make_complex(self.valueOf() - other.$real, other.$imag)
    }
    var rsub = $B.$getattr(other, "__rsub__", _b_.None)
    if(rsub !== _b_.None){return rsub(self)}
    throw $err("-", other)
}