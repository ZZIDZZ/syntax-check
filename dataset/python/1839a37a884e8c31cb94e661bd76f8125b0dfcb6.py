def distance(image_path, other_image_path):
    """ Compute the hamming distance between two images"""
    image_hash = average_hash(image_path)
    other_image_hash = average_hash(other_image_path)

    return hash_distance(image_hash, other_image_hash)