@Then("^the instruction generated should be \"([^\"]*)\"$")
    public void the_instruction_generated_should_be(String command) throws Throwable {
        verify(context.getDrinkMaker()).executeCommand(eq(command));
    }