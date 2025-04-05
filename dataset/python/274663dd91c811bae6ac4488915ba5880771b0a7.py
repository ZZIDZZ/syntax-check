def hero_card(card: HeroCard) -> Attachment:
        """
        Returns an attachment for a hero card. Will raise a TypeError if 'card' argument is not a HeroCard.

        Hero cards tend to have one dominant full width image and the cards text & buttons can
        usually be found below the image.
        :return:
        """
        if not isinstance(card, HeroCard):
            raise TypeError('CardFactory.hero_card(): `card` argument is not an instance of an HeroCard, '
                            'unable to prepare attachment.')

        return Attachment(content_type=CardFactory.content_types.hero_card,
                          content=card)