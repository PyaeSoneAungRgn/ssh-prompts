![Demo](https://res.cloudinary.com/pyaesoneaung/image/upload/v1690730841/opensources/ssh-prompts/demo.png)

# SSH Prompts

SSH account management cli tool developed with Laravel Prompts and Laravel Zero

## Global Installation

```bash
composer global require pyaesoneaung/ssh-prompts
ssh-prompts
```

## Local Installation

Download the `ssh-prompts` file from the [Release page](https://github.com/PyaeSoneAungRgn/ssh-prompts/releases)

```bash
cd /path/to/download/folder
chmod +x ssh-prompts
./ssh-prompts
```

## Usage

#### List all host

```bash
ssh-prompts hosts
```

#### Create a host

```bash
ssh-prompts create
```

#### Update a host

```bash
ssh-prompts edit
```

#### Update a host

```bash
ssh-prompts delete
```

## Security

I have built this project for personal use. SSH Prompts store all hosts' information in the `~/.ssh-prompts/db_ssh_prompts.json` file. For added security, you have the option to delete the `~/.ssh-prompts/db_ssh_prompts.json` file by running the command `ssh-prompts clean`. This ensures that your sensitive data is removed from the storage when necessary.
