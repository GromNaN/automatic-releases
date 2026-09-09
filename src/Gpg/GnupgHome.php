<?php

declare(strict_types=1);

namespace Laminas\AutomaticReleases\Gpg;

use Psl\Env;
use Psl\Filesystem;

/**
 * Provides the GnuPG home directory used by every gpg invocation, so signing state stays inside the
 * container and never leaks through the $HOME volume shared between GitHub Actions steps.
 */
final class GnupgHome
{
    /** @return array<string, string> environment variables to pass to a subprocess that uses gpg */
    public static function environment(): array
    {
        $path = Env\temp_dir() . '/gnupg';

        Filesystem\create_directory($path, 0o700);

        return ['GNUPGHOME' => $path];
    }
}
