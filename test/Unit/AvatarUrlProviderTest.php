<?php

declare(strict_types=1);

/**
 * Copyright (c) 2019 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/localheinz/faker-provider
 */

namespace Localheinz\Faker\Provider\Test\Unit;

use Faker\Factory;
use Faker\Generator;
use Localheinz\Faker\Provider\AvatarUrlProvider;
use PHPUnit\Framework;

/**
 * @internal
 *
 * @covers \Localheinz\Faker\Provider\AvatarUrlProvider
 */
final class AvatarUrlProviderTest extends Framework\TestCase
{
    /**
     * @dataProvider providerInvalidAdorableAvatarUrlIdentifier
     *
     * @param string $identifier
     */
    public function testAdorableAvatarUrlRejectsInvalidIdentifier(string $identifier): void
    {
        $faker = self::createFaker();

        $size = $faker->numberBetween(200, 450);

        $provider = new AvatarUrlProvider($faker);

        self::expectException(\InvalidArgumentException::class);
        self::expectExceptionMessage('Identifier cannot contain new-line characters.');

        $provider->adorableAvatarUrl(
            $identifier,
            $size
        );
    }

    public function providerInvalidAdorableAvatarUrlIdentifier(): \Generator
    {
        $faker = self::createFaker();

        $newLineCharacters = [
            "\n",
            "\r",
            "\r\n",
        ];

        foreach ($newLineCharacters as $newLineCharacter) {
            /** @var string[] $words */
            $words = $faker->words;

            $invalidIdentifier = \implode(
                $newLineCharacter,
                $words
            );

            yield [
                $invalidIdentifier,
            ];
        }
    }

    /**
     * @dataProvider providerInvalidAdorableAvatarUrlSize
     *
     * @param int $size
     */
    public function testAdorableAvatarUrlRejectsInvalidSize(int $size): void
    {
        $faker = self::createFaker();

        $identifier = $faker->userName;

        $provider = new AvatarUrlProvider($faker);

        self::expectException(\InvalidArgumentException::class);
        self::expectExceptionMessage(\sprintf(
            'Size needs to be greater than 0, but %d is not.',
            $size
        ));

        $provider->adorableAvatarUrl(
            $identifier,
            $size
        );
    }

    public function testAdorableAvatarUrlReturnsAdorableAvatarUrl(): void
    {
        $faker = self::createFaker();

        $identifier = $faker->userName;
        $size = $faker->numberBetween(200, 450);

        $provider = new AvatarUrlProvider($faker);

        $expected = \sprintf(
            'https://api.adorable.io/avatars/%d/%s.png',
            $size,
            $identifier
        );

        self::assertSame($expected, $provider->adorableAvatarUrl($identifier, $size));
    }

    public function testAdorableAvatarUrlReturnsAdorableAvatarUrlWithTrimmedUserName(): void
    {
        $faker = self::createFaker();

        $identifier = $faker->userName;
        $paddedIdentifier = \str_pad(
            $identifier,
            \mb_strlen($identifier) + 10,
            ' ',
            \STR_PAD_BOTH
        );
        $size = $faker->numberBetween(200, 450);

        $provider = new AvatarUrlProvider($faker);

        $expected = \sprintf(
            'https://api.adorable.io/avatars/%d/%s.png',
            $size,
            $identifier
        );

        self::assertSame($expected, $provider->adorableAvatarUrl($paddedIdentifier, $size));
    }

    public function providerInvalidAdorableAvatarUrlSize(): array
    {
        return [
            'int-less-than-minus-1' => [-1 * self::createFaker()->numberBetween(2)],
            'int-minus-1' => [-1],
            'int-zero' => [0],
        ];
    }

    private static function createFaker(): Generator
    {
        $generator = Factory::create();

        $generator->seed(9001);

        return $generator;
    }
}
