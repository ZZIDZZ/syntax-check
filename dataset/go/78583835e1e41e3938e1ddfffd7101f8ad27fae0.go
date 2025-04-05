func (d *PostgresDialect) SQLType(v interface{}, autoIncrement bool, size uint64) (name string, allowNull bool) {
	switch v.(type) {
	case bool:
		return "boolean", false
	case *bool, sql.NullBool:
		return "boolean", true
	case int8, int16, uint8, uint16:
		return d.smallint(autoIncrement), false
	case *int8, *int16, *uint8, *uint16:
		return d.smallint(autoIncrement), true
	case int, int32, uint, uint32:
		return d.integer(autoIncrement), false
	case *int, *int32, *uint, *uint32:
		return d.integer(autoIncrement), true
	case int64, uint64:
		return d.bigint(autoIncrement), false
	case *int64, *uint64, sql.NullInt64:
		return d.bigint(autoIncrement), true
	case string:
		return d.varchar(size), false
	case *string, sql.NullString:
		return d.varchar(size), true
	case []byte:
		return "bytea", true
	case time.Time:
		return "timestamp with time zone", false
	case *time.Time:
		return "timestamp with time zone", true
	case Rat:
		return fmt.Sprintf("numeric(%d, %d)", decimalPrecision, decimalScale), false
	case *Rat:
		return fmt.Sprintf("numeric(%d, %d)", decimalPrecision, decimalScale), true
	case Float32, Float64:
		return "double precision", false
	case *Float32, *Float64:
		return "double precision", true
	case float32, *float32, float64, *float64, sql.NullFloat64:
		panic(ErrUsingFloatType)
	}
	panic(fmt.Errorf("PostgresDialect: unsupported SQL type: %T", v))
}