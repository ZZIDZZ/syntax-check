def _validate_observation_data(
    kernel, observation_index_points, observations):
  """Ensure that observation data and locations have consistent shapes.

  This basically means that the batch shapes are broadcastable. We can only
  ensure this when those shapes are fully statically defined.


  Args:
    kernel: The GP kernel.
    observation_index_points: the observation data locations in the index set.
    observations: the observation data.

  Raises:
    ValueError: if the observations' batch shapes are not broadcastable.
  """
  # Check that observation index points and observation counts broadcast.
  ndims = kernel.feature_ndims
  if (tensorshape_util.is_fully_defined(
      observation_index_points.shape[:-ndims]) and
      tensorshape_util.is_fully_defined(observations.shape)):
    index_point_count = observation_index_points.shape[:-ndims]
    observation_count = observations.shape
    try:
      tf.broadcast_static_shape(index_point_count, observation_count)
    except ValueError:
      # Re-raise with our own more contextual error message.
      raise ValueError(
          'Observation index point and observation counts are not '
          'broadcastable: {} and {}, respectively.'.format(
              index_point_count, observation_count))