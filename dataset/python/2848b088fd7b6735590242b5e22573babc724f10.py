def name(self):
        r"""Access descriptor value by descriptor name or instance.

        >>> from mordred import Calculator, descriptors
        >>> from rdkit import Chem
        >>> result = Calculator(descriptors)(Chem.MolFromSmiles("C1CCCCC1"))
        >>> result.name["C2SP3"]
        6

        """
        if self._name_to_value is None:
            self._name_to_value = {str(d): v for d, v in zip(self._descriptors, self._values)}

        return GetValueByName(self._name_to_value)