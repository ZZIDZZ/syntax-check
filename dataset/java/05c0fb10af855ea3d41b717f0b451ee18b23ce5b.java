void writeToFiler(Filer filer) throws IOException {
        ClassName targetClassName = ClassName.get(classPackage, targetClass);
        TypeSpec.Builder barberShop = TypeSpec.classBuilder(className)
                .addModifiers(Modifier.PUBLIC)
                .addTypeVariable(TypeVariableName.get("T", targetClassName))
                .addMethod(generateStyleMethod())
                .addMethod(generateCheckParentMethod());

        if (parentBarbershop == null) {
            barberShop.addSuperinterface(ParameterizedTypeName.get(ClassName.get(Barber.IBarbershop.class), TypeVariableName.get("T")));
            barberShop.addField(FieldSpec.builder(WeakHashSet.class, "lastStyledTargets", Modifier.PROTECTED).initializer("new $T()", WeakHashSet.class).build());
        } else {
            barberShop.superclass(ParameterizedTypeName.get(ClassName.bestGuess(parentBarbershop), TypeVariableName.get("T")));
        }

        JavaFile javaFile = JavaFile.builder(classPackage, barberShop.build()).build();
        javaFile.writeTo(filer);
    }