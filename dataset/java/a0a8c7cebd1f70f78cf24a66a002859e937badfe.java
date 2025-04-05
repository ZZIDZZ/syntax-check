public static Restriction in(String name, Object value){
        return new Restriction(Operator.IN, name, value);
    }