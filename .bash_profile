# .bash_profile

# Get the aliases and functions
if [ -f ~/.bashrc ]; then
	. ~/.bashrc
fi

# User specific environment and startup programs

PATH=$PATH:$HOME/bin:./

export PATH
unset USERNAME

# james' aliases of glory
alias    mysql="mysql -u tchess --password=benrussiajamesjapan tchess"
alias       la="ls -la"
alias     pico="pico -w"
