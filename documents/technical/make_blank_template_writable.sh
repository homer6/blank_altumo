
# if you're creating a new project, clone blank project with readonly git
# git clone git://github.com/homer6/blank_altumo.git my-new-project-name
# you're done!

# if you're just adding another blank_altumo project so it can be changed, clone
git clone -o github git@github.com:homer6/blank_altumo.git
cd blank_altumo

# start here for an existing blank_altumo project (or continued from above new blank project)
# run this if it doesn't have the git writable remote "github" already
# git remote add github git@github.com:homer6/blank_altumo.git
git pull
git submodule sync
git submodule update --init --recursive

cd htdocs/project/plugins/sfAltumoPlugin
git checkout master
git pull
git remote add github git@github.com:homer6/sfAltumoPlugin.git
git submodule sync
git submodule update --init --recursive

cd lib/vendor/altumo
git checkout master
git pull
git remote add github git@github.com:homer6/altumo.git
git submodule sync
git submodule update --init --recursive

cd lib/javascript/vendor/google/closure-library
git checkout master
git pull
git remote add github git@github.com:homer6/google-closure-library.git
git submodule sync
git submodule update --init --recursive

cd ../../../../../../../../../../../../


# if this is an existing project, in each of the above repositories, you may have to rename the remote before adding the new one:
# git remote rename github origin



