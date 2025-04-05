func (serialize *SerializableMeta) GetSerializableArgument(serializableMetaInterface SerializableMetaInterface) interface{} {
	if serialize.Value.OriginalValue != nil {
		return serialize.Value.OriginalValue
	}

	if res := serializableMetaInterface.GetSerializableArgumentResource(); res != nil {
		value := res.NewStruct()
		json.Unmarshal([]byte(serialize.Value.SerializedValue), value)
		return value
	}
	return nil
}