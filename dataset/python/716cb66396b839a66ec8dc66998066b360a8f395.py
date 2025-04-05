def get_features(self, x, layers):
        '''Evaluate layer outputs for `x`'''
        if not layers:
            return None
        inputs = [self.net.input]
        if self.learning_phase is not None:
            inputs.append(self.learning_phase)
        f = K.function(inputs, [self.get_layer_output(layer_name) for layer_name in layers])
        feature_outputs = f([x])
        features = dict(zip(layers, feature_outputs))
        return features