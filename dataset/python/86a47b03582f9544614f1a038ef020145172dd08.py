def run_cmake(arg=""):
    """
    Forcing to run cmake
    """
    if ds.find_executable('cmake') is None:
        print "CMake  is required to build zql"
        print "Please install cmake version >= 2.8 and re-run setup"
        sys.exit(-1)

    print "Configuring zql build with CMake.... "
    cmake_args = arg
    try:
        build_dir = op.join(op.split(__file__)[0], 'build')
        dd.mkpath(build_dir)
        os.chdir("build")
        ds.spawn(['cmake', '..'] + cmake_args.split())
        ds.spawn(['make', 'clean'])
        ds.spawn(['make'])
        os.chdir("..")
    except ds.DistutilsExecError:
        print "Error while running cmake"
        print "run 'setup.py build --help' for build options"
        print "You may also try editing the settings in CMakeLists.txt file and re-running setup"
        sys.exit(-1)