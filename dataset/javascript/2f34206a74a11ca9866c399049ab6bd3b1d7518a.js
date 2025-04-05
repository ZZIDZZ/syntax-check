function fromJSON(object) {
        if (object instanceof ops.Op) return object; // If already patch, return it
        if (object === undefined) return ops.NOP;
        if (object.op) {
            if (object.op === ops.Rpl.name)
                return new ops.Rpl(object.data);
            if (object.op === ops.Ins.name)
                return new ops.Ins(object.data);
            else if (object.op === ops.NOP.name)
                return ops.NOP;
            else if (object.op === ops.DEL.name)
                return ops.DEL;
            else if (object.op === ops.Mrg.name) 
                return new ops.Mrg(utils.map(object.data, fromJSON));
            else if (object.op === ops.Map.name) 
                return new ops.Map(object.data.map(([key,op]) => [key, fromJSON(op)]));
            else if (object.op === ops.Arr.name) 
                return new ops.Arr(object.data.map(([key,op]) => [key, fromJSON(op)]));
            else throw new Error('unknown diff.op ' + object.op);
        } else {
            return new ops.Rpl(object);   
        }    
}