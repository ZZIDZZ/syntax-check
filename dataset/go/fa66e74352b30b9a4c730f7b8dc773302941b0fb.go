func RelationshipValidator(model coal.Model, catalog *coal.Catalog, excludedFields ...string) *Callback {
	// prepare lists
	dependentResources := make(map[coal.Model]string)
	references := make(map[string]coal.Model)

	// iterate through all fields
	for _, field := range coal.Init(model).Meta().Relationships {
		// exclude field if requested
		if Contains(excludedFields, field.Name) {
			continue
		}

		// handle has-one and has-many relationships
		if field.HasOne || field.HasMany {
			// get related model
			relatedModel := catalog.Find(field.RelType)
			if relatedModel == nil {
				panic(fmt.Sprintf(`fire: missing model in catalog: "%s"`, field.RelType))
			}

			// get related bson field
			bsonField := ""
			for _, relatedField := range relatedModel.Meta().Relationships {
				if relatedField.RelName == field.RelInverse {
					bsonField = relatedField.Name
				}
			}
			if bsonField == "" {
				panic(fmt.Sprintf(`fire: missing field for inverse relationship: "%s"`, field.RelInverse))
			}

			// add relationship
			dependentResources[relatedModel] = bsonField
		}

		// handle to-one and to-many relationships
		if field.ToOne || field.ToMany {
			// get related model
			relatedModel := catalog.Find(field.RelType)
			if relatedModel == nil {
				panic(fmt.Sprintf(`fire: missing model in catalog: "%s"`, field.RelType))
			}

			// add relationship
			references[field.Name] = relatedModel
		}
	}

	// create callbacks
	cb1 := DependentResourcesValidator(dependentResources)
	cb2 := VerifyReferencesValidator(references)

	return C("RelationshipValidator", func(ctx *Context) bool {
		return cb1.Matcher(ctx) || cb2.Matcher(ctx)
	}, func(ctx *Context) error {
		// run dependent resources validator
		if cb1.Matcher(ctx) {
			err := cb1.Handler(ctx)
			if err != nil {
				return err
			}
		}

		// run dependent resources validator
		if cb2.Matcher(ctx) {
			err := cb2.Handler(ctx)
			if err != nil {
				return err
			}
		}

		return nil
	})
}