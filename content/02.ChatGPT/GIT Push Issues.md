---
created: 2024-10-24T12:56:01-04:00
modified: 2024-11-08T09:34:14-05:00
tags:
  - git
  - push
  - github
  - not-authorized
  - errors
  - push-issues
  - hostname
  - MERGE-HEAD-exists
  - github-issues
  - git-issues
---

## Could not resolve hostname github.com: Name or service not known

```bash
git pull --tags origin main
ssh: Could not resolve hostname github.com: Name or service not known
fatal: Could not read from remote repository.

Please make sure you have the correct access rights
and the repository exists.
```

### Skip if ssh key is already configured

**Test SSH Connection**:

- Open Command Prompt and run:

```bash
ssh -T git@github.com
```

- This checks if your SSH setup with GitHub works correctly.

**Add SSH Key to Agent**:

- Ensure your SSH key is added to the SSH agent:

```bash
ssh-add ~/.ssh/id_rsa
```

Replace `id_rsa` with your key file if it’s different.

---

### What actually fixed the issue

Use a text editor to open `C:\Users\<YourUsername>\.ssh\config` and ensure it includes:

```bash
Host github.com
	Hostname github.com
	User git
	IdentityFile ~/.ssh/id_rsa
```

---

## MERGE HEAD exists

When git error says:

> "you have not concluded your merge (MERGE HEAD exists)

force update with this

```bash
git commit -m "Your commit message here"
```

---

## Not allowed, access denied

The "do not have write permissions" issue when pushing to a GitHub repository can be caused by several factors. Here are steps you can take to troubleshoot and resolve the issue:

### 1. Check your Git configuration

Make sure Git is configured to use the correct user credentials:

```bash
git config --global user.name "Yohn"
git config --global user.email "john.skem9@gmail.com"
```

### 2. Verify your remote URL

Check if your remote URL is set correctly for the repository. You can run the following command in your terminal:

```bash
git remote -v
```

Look for the URL. If it uses `https`, ensure you are using the correct credentials. If it uses `ssh`, make sure your SSH key is set up correctly.

### 3. Use SSH instead of HTTPS (optional)

If you’re using HTTPS and facing issues, try switching to SSH. Here’s how to set it up:

- Generate an SSH key if you don't already have one:

  ```bash
  ssh-keygen -t rsa -b 4096 -C "john.skem9@gmail.com"
  ```

- Add the SSH key to your GitHub account. Copy the public key:

  ```bash
  cat ~/.ssh/id_rsa.pub
  ```

- Log in to GitHub, go to **Settings** > **SSH and GPG keys** > **New SSH key**, and paste the key.

- Update your remote URL to use SSH:

  ```bash
  git remote set-url origin git@github.com:username/repo.git
  ```

### 4. Authentication issues

- If you're using HTTPS, you may need to update your Git credentials. Sometimes cached passwords can lead to issues. You can clear the credentials with:

  ```bash
  git credential-cache exit
  ```

- When you push again, you may be prompted to enter your GitHub username and password (note that GitHub now requires a personal access token instead of your password).

### 5. Repository permissions

Make sure that your GitHub account has the necessary write permissions for the repository. If it's an organization repository, ensure you’re a member of the team with write access or try setting your permissions through GitHub's repository settings.

### 6. Visual Studio Code (VSCode) settings

If you are using VSCode, ensure that the Git extension is enabled and correctly configured to use your credentials. You may want to restart VSCode after making changes.

### 7. Test the push command

Try pushing from the command line directly, instead of through VSCode, to see if you get the same error:

```bash
git push origin main
```

(Replace `main` with your current branch name.)

### Summary

Follow these steps methodically to identify and resolve the permissions issue. If you continue to encounter problems, providing any error messages or logs can help with further troubleshooting.
