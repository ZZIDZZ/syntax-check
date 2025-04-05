def choose(self, mol):
        """Return the largest covalent unit.

        The largest fragment is determined by number of atoms (including hydrogens). Ties are broken by taking the
        fragment with the higher molecular weight, and then by taking the first alphabetically by SMILES if needed.

        :param mol: The molecule to choose the largest fragment from.
        :type mol: rdkit.Chem.rdchem.Mol
        :return: The largest fragment.
        :rtype: rdkit.Chem.rdchem.Mol
        """
        log.debug('Running LargestFragmentChooser')
        # TODO: Alternatively allow a list of fragments to be passed as the mol parameter
        fragments = Chem.GetMolFrags(mol, asMols=True)
        largest = None
        for f in fragments:
            smiles = Chem.MolToSmiles(f, isomericSmiles=True)
            log.debug('Fragment: %s', smiles)
            organic = is_organic(f)
            if self.prefer_organic:
                # Skip this fragment if not organic and we already have an organic fragment as the largest so far
                if largest and largest['organic'] and not organic:
                    continue
                # Reset largest if it wasn't organic and this fragment is organic
                if largest and organic and not largest['organic']:
                    largest = None
            # Count atoms
            atoms = 0
            for a in f.GetAtoms():
                atoms += 1 + a.GetTotalNumHs()
            # Skip this fragment if fewer atoms than the largest
            if largest and atoms < largest['atoms']:
                continue
            # Skip this fragment if equal number of atoms but weight is lower
            weight = rdMolDescriptors.CalcExactMolWt(f)
            if largest and atoms == largest['atoms'] and weight < largest['weight']:
                continue
            # Skip this fragment if equal atoms and equal weight but smiles comes last alphabetically
            if largest and atoms == largest['atoms'] and weight == largest['weight'] and smiles > largest['smiles']:
                continue
            # Otherwise this is the largest so far
            log.debug('New largest fragment: %s (%s)', smiles, atoms)
            largest = {'smiles': smiles, 'fragment': f, 'atoms': atoms, 'weight': weight, 'organic': organic}
        return largest['fragment']