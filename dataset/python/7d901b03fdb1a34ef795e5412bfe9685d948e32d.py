def from_args(args):
        """Takes arguments parsed from argparse and returns a profile."""
        # If the args specify a username explicitly, don't load from file.
        if args.username is not None or args.identity_file is not None:
            profile = LsiProfile()
        else:
            profile = LsiProfile.load(args.profile)
        profile.override('username', args.username)
        profile.override('identity_file', args.identity_file)
        profile.override('command', args.command)
        profile.no_prompt = args.no_prompt
        profile.filters.extend(args.filters)
        profile.exclude.extend(args.exclude)
        if profile.identity_file is not None:
            profile.identity_file = os.path.expanduser(profile.identity_file)
        return profile